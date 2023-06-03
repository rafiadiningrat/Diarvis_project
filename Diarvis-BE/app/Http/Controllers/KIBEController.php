<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KIBEModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KIBEExport;

class KIBEController extends Controller
{
    //
    public function getAllKibE()
{
    $kib = KIBEModel::get();
    return $kib;
}

public function detail($id_aset_e)
{
    $kibE = KIBEModel::where('id_aset_e', $id_aset_e)->first();

    if (!$kibE) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $kibE
    ], 200);
}

public function getKibE($kode_upb)
{
    $kib = KIBEModel::with('bidang', 'unit', 'subUnit', 'upb')->where('kode_upb', $kode_upb)->get();
    $KibResponse = [];
    foreach ($kib as $value) {
        array_push($KibResponse, [
            'nama_bidang' => $value->bidang->nama_bidang,
            'nama_unit' => $value->unit->nama_unit,
            'nama_sub_unit' => $value->subUnit->nama_sub_unit,
            'nama_upb' => $value->upb->nama_upb,
            'id_aset_b' => $value->id_aset_b,
            'kode_pemilik' => $value->kode_pemilik,
            'tgl_perolehan' => $value->tgl_perolehan,
            'judul' => $value->judul,
            'pencipta' => $value->pencipta,
            'bahan' => $value->bahan,
            'ukuran' => $value->ukuran,
            'asal_usul' => $value->asal_usul,
            'nomor_mesin' => $value->nomor_mesin,
            'asal-usul' => $value->asal_usul,
            'kondisi' => $value->kondisi,
            'harga' => $value->harga,
        ]);
    }
    return response()->json([
        'success' => true,
        'data' => $KibResponse
        // 'data'=>$unit[0]
    ], 200);
}

public function exportToExcel()
    {
    //     $export = new KibBExport();
    // $fileName = 'kib_b_data.xlsx';

    // $filePath = 'temp/' . $fileName;
    // $storagePath = storage_path('app/' . $filePath);

    // Excel::store($export, $storagePath);

    // $file = new \SplFileInfo($storagePath);
    // $realPath = $file->getRealPath();

    // return response()->download($realPath, $fileName, [
    //     'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    // ])->deleteFileAfterSend();

    $export = new KIBEExport();
    $fileName = 'kib_e_data.xlsx';

    Excel::store($export, 'temp/' . $fileName, 'local');

    return response()->download(storage_path('app/temp/' . $fileName), $fileName, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ])->deleteFileAfterSend();

    // $export = new KIBBExport();
    // $fileName = 'kib_b_data.xlsx';

    // $filePath = 'D:/TA/' . $fileName;

    // Excel::store($export, $filePath, 'local');

    // return Storage::download($filePath, $fileName, [
    //     'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //     'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    // ]);
}
}
