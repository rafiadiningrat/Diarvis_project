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
            'masa_manfaat' =>$value->masa_manfaat, 
            'nilai_sisa' =>$value->nilai_sisa,
            'keterangan'=>$value->keterangan, 
            'tahun' =>$value->tahun,
            'no_sp2d' =>$value->no_sp2d, 
            'tgl_pembukuan' =>$value->tgl_pembukuan,
            'no_skguna' =>$value->no_skguna,  
            'log_user' =>$value->log_user, 
            'log_entry' =>$value->log_entry, 
            'kd_ka' =>$value->kd_ka, 
            'no_sippt' =>$value->no_sippt, 
            'kd_hapus' =>$value->kd_hapus, 
            'kd_aset8' =>$value->kd_aset8, 
            'kd_aset80' =>$value->kd_aset80, 
            'kd_aset81' =>$value->kd_aset81, 
            'kd_aset82' =>$value->kd_aset82, 
            'kd_aset83' =>$value->kd_aset83, 
            'kd_aset84' =>$value->kd_aset84, 
            'kd_aset85' =>$value->kd_aset85, 
            'created_at' =>$value->created_at, 
            'created_by' =>$value->created_by, 
            'update_at' =>$value->update_at, 
            'update_by' =>$value->update_by, 
            'jumlah' =>$value->jumlah, 
            'is_aset_yang_ditemukan' =>$value->is_aset_yang_ditemukan, 
            'no_reg8' =>$value->no_reg8, 
            'jenis_aset' =>$value->jenis_aset,
	
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
