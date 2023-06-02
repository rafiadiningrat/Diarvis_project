<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\KIBBExport;
use App\Models\PengusulanPenghapusanAsetBModel;
use App\Exports\KIBBCustomExport;
use App\Models\KIBBModel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class KIBBController extends Controller
{
    //
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

    $export = new KIBBExport();
    $fileName = 'kib_b_data.xlsx';

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

public function exportData()
{
    $data = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)
    ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
    ->select(
        'kib_b.id_aset_b',
        'kib_b.no_reg8',
        'kib_b.merk',
        'kib_b.type',
        'kib_b.cc',
        'kib_b.bahan',
        'kib_b.tgl_perolehan',
        'kib_b.nomor_pabrik',
        'kib_b.nomor_rangka',
        'kib_b.nomor_mesin',
        'kib_b.nomor_polisi',
        'kib_b.nomor_bpkb',
        'kib_b.asal_usul',
        'kib_b.kondisi',
        'kib_b.harga',
        'kib_b.keterangan',
        'kib_b.sisa_umur',
        'pengusulan_penghapusan_aset_b.status_verifikasi',
        'pengusulan_penghapusan_aset_b.alasan_penghapusan',
    )
    ->get();

        $export = new KIBBCustomExport($data);

        return Excel::download($export, 'penghapusan_aset_b_report.xlsx');;
}

public function getAllKibB()
{
    $upb = KIBBModel::get();
    return $upb;
}

public function getKibB($kode_upb)
{
    $kib = KIBBModel::with('bidang', 'unit', 'subUnit', 'upb')->where('kode_upb', $kode_upb)->get();
    $KibResponse = [];
    foreach ($kib as $value) {
        array_push($KibResponse, [
            'nama_bidang' => $value->bidang->nama_bidang,
            'nama_unit' => $value->unit->nama_unit,
            'nama_sub_unit' => $value->subUnit->nama_sub_unit,
            'nama_upb' => $value->upb->nama_upb,
            'id_aset_b' => $value->id_aset_b,
            'kode_pemilik' => $value->kode_pemilik,
            'merk' => $value->merk,
            'cc' => $value->cc,
            'bahan' => $value->bahan,
            'tgl_perolehan' => $value->tgl_perolehan,
            'nomor_pabrik' => $value->nomor_pabrik,
            'nomor_rangka' => $value->inomor_rangka,
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


}
