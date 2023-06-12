<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\KIBBExport;
use App\Models\PengusulanPenghapusanAsetBModel;
use App\Exports\KIBBCustomExport;
use App\Models\KIBBModel;
use App\Models\KIBEModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Response;


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
    $data = PengusulanPenghapusanAsetBModel::whereNotNull('status_verifikasi')
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
        'pengusulan_penghapusan_aset_b.keterangan_verifikasi',
    )
    ->get();

    // $dataWithCustomColumn = $data->map(function ($item) {
    //     $item['Nomor'] = $item->nomor_pabrik . ' - ' . $item->nomor_rangka . ' - ' . $item->nomor_mesin . ' - ' . $item->nomor_polisi . ' - ' . $item->nomor_bpkb;
    //     return $item;
    // });

        $export = new KIBBCustomExport($data);

        return Excel::download($export, 'penghapusan_aset_b_report.xlsx');;
}

public function generatePDF()
    {

        // Query untuk mendapatkan saldo akhir KIB_B
    $saldoAkhirKIBB = KIBBModel::whereIn('id_aset_b', function ($query) {
        $query->select('id_aset_b')
            ->from('pengusulan_penghapusan_aset_b')
            ->where('status_penghapusan', true);
    })
    ->sum('harga');

// Query untuk mendapatkan saldo akhir KIB_E
    $saldoAkhirKIBE = KIBEModel::whereIn('id_aset_e', function ($query) {
        $query->select('id_aset_e')
            ->from('pengusulan_penghapusan_aset_e')
            ->where('status_penghapusan', true);
    })
    ->sum('harga');

// Buat objek PDF
$pdf = FacadePdf::loadHTML('<h1>Saldo Akhir:</h1>
                     <p>Saldo Akhir KIB_B: ' . $saldoAkhirKIBB . '</p>
                     <p>Saldo Akhir KIB_E: ' . $saldoAkhirKIBE . '</p>');

// Simpan PDF ke file
$filename = 'saldo_akhir.pdf';

// Set header Content-Type
$headers = [
    'Content-Type' => 'application/pdf',
];

// Menggunakan response() untuk mengembalikan response PDF
return response($pdf->output(), Response::HTTP_OK, $headers)->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        // // Query untuk mendapatkan saldo akhir
        // $saldoAkhir = KIBBModel::whereIn('id_aset_b', function ($query) {
        //         $query->select('id_aset_b')
        //             ->from('pengusulan_penghapusan_aset_b')
        //             ->where('status_penghapusan', true);
        //     })
        //     ->sum('harga');

        // // Buat objek PDF
        // $pdf = FacadePdf::loadHTML('<h1>Saldo Akhir: ' . $saldoAkhir . '</h1>');

        // // Simpan PDF ke file
        // $filename = 'saldo_akhir.pdf';
    
        // // Set header Content-Type
        // $headers = [
        //     'Content-Type' => 'application/pdf',
        // ];
    
        // // Menggunakan response() untuk mengembalikan response PDF
        // return response($pdf->output(), Response::HTTP_OK, $headers)->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

public function getAllKibB()
{
    $kibB = KIBBModel::get();
    return $kibB;
}

public function detail($id_aset_b)
{
    $kibB = KIBBModel::where('id_aset_b', $id_aset_b)->first();

    if (!$kibB) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $kibB
    ], 200);
}

public function getKibB($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
{

//     $kib = KIBBModel::join('bidang', 'kib_b.kode_bidang', '=', 'bidang.kode_bidang')
//     ->join('unit', 'kib_b.kode_unit', '=', 'unit.kode_unit')
//     ->join('sub_unit', 'kib_b.kode_sub_unit', '=', 'sub_unit.kode_sub_unit')
//     ->join('upb', 'kib_b.kode_upb', '=', 'upb.kode_upb')
//     ->select(
//         'bidang.kode_bidang',
//         'bidang.nama_bidang',
//         'unit.kode_unit',
//         'unit.nama_unit',
//         'sub_unit.kode_sub_unit',
//         'sub_unit.nama_sub_unit',
//         'upb.kode_upb',
//         'upb.nama_upb',
//         'kib_b.*'
//     )
//     ->where('kib_b.kode_bidang', $kode_bidang)
//     ->where('kib_b.kode_unit', $kode_unit)
//     ->where('kib_b.kode_sub_unit', $kode_sub_unit)
//     ->where('kib_b.kode_upb', $kode_upb)
//     ->get();

// $KibResponse = [];
// foreach ($kib as $value) {
//     array_push($KibResponse, [
//         'kode_bidang' => $value->kode_bidang,
//         'nama_bidang' => $value->nama_bidang,
//         'kode_unit' => $value->kode_unit,
//         'nama_unit' => $value->nama_unit,
//         'kode_sub_unit' => $value->kode_sub_unit,
//         'nama_sub_unit' => $value->nama_sub_unit,
//         'kode_upb' => $value->kode_upb,
//         'nama_upb' => $value->nama_upb,
//         'id_aset_b' => $value->id_aset_b,
//         'kode_pemilik' => $value->kode_pemilik,
//         'merk' => $value->merk,
//         'cc' => $value->cc,
//         'bahan' => $value->bahan,
//         'tgl_perolehan' => $value->tgl_perolehan,
//         'nomor_pabrik' => $value->nomor_pabrik,
//         'nomor_rangka' => $value->nomor_rangka, // Perbaikan typo di sini
//         'nomor_mesin' => $value->nomor_mesin, // Perbaikan typo di sini
//         'asal_usul' => $value->asal_usul,
//         'kondisi' => $value->kondisi,
//         'harga' => $value->harga,
//         'masa_manfaat' => $value->masa_manfaat, 
//         'nilai_sisa' => $value->nilai_sisa,
//         'keterangan' => $value->keterangan, 
//         'tahun' => $value->tahun, 
//         'no_sp2d' => $value->no_sp2d, 
//         'no_skguna' => $value->no_skguna, 
//         'kd_penyusutan' => $value->kd_penyusutan, 
//         'log_user' => $value->log_user, 
//         'log_entry' => $value->log_entry, 
//         'kd_ka' => $value->kd_ka, 
//         'no_sippt' => $value->no_sippt, 
//         'kd_hapus' => $value->kd_hapus, 
//         'kd_aset8' => $value->kd_aset8, 
//         'kd_aset80' => $value->kd_aset80, 
//         'kd_aset81' => $value->kd_aset81, 
//         'kd_aset82' => $value->kd_aset82, 
//         'kd_aset83' => $value->kd_aset83, 
//         'kd_aset84' => $value->kd_aset84, 
//         'kd_aset85' => $value->kd_aset85, 
//         'created_at' => $value->created_at, 
//         'created_by' => $value->created_by, 
//         'updated_at' => $value->updated_at, // Perbaikan typo di sini
//         'updated_by' => $value->updated_by, // Perbaikan typo di sini
//         'nilai_susut1' => $value->nilai_susut1, 
//         'nilai_susut2' => $value->nilai_susut2, 
//         'akum_susut' => $value->akum_susut, 
//         'sisa_umur' => $value->sisa_umur, 
//         'is_aset_yang_ditemukan' => $value->is_aset_yang_ditemukan, 
//         'no_reg8' => $value->no_reg8, 
//         'jenis_aset' => $value->jenis_aset, 
//         'kd_aset' => $value->kd_aset, 
//         'kd_aset0' => $value->kd_aset0,
//     ]);
// }

// return response()->json([
//     'success' => true,
//     'data' => $KibResponse
// ], 200);

    $kib =KIBBModel::join('bidang', 'kib_b.kode_bidang', '=', 'bidang.kode_bidang')
    ->join('unit', function ($join) {
        $join->on('kib_b.kode_bidang', '=', 'unit.kode_bidang')
            ->on('kib_b.kode_unit', '=', 'unit.kode_unit');
    })
    ->join('sub_unit', function ($join) {
        $join->on('kib_b.kode_bidang', '=', 'sub_unit.kode_bidang')
            ->on('kib_b.kode_unit', '=', 'sub_unit.kode_unit')
            ->on('kib_b.kode_sub_unit', '=', 'sub_unit.kode_sub_unit');
    })
    ->join('upb', function ($join) {
        $join->on('kib_b.kode_bidang', '=', 'upb.kode_bidang')
            ->on('kib_b.kode_unit', '=', 'upb.kode_unit')
            ->on('kib_b.kode_sub_unit', '=', 'upb.kode_sub_unit')
            ->on('kib_b.kode_upb', '=', 'upb.kode_upb');
    })
    ->select(
                    'bidang.kode_bidang',
                    'bidang.nama_bidang',
                    'unit.kode_unit',
                    'unit.nama_unit',
                    'sub_unit.kode_sub_unit',
                    'sub_unit.nama_sub_unit',
                    'upb.kode_upb',
                    'upb.nama_upb',
                    'kib_b.*'
                )
                ->where('upb.kode_bidang', $kode_bidang)
                ->where('upb.kode_unit', $kode_unit)
                ->where('upb.kode_sub_unit', $kode_sub_unit)
                ->where('upb.kode_upb', $kode_upb)
                
                ->get();

                


    
    // $kib = KIBBModel::with('bidang', 'unit', 'subUnit', 'upb')
    // ->where('kode_bidang', $kode_bidang)
    // ->where('kode_unit', $kode_unit)
    // ->where('kode_sub_unit', $kode_sub_unit)
    // ->where('kode_upb', $kode_upb)->get();

    $KibResponse = [];
    foreach ($kib as $value) {
        array_push($KibResponse, [
            'kode_bidang' => $value->kode_bidang,
            'nama_bidang' => $value->nama_bidang,
            'kode_unit' => $value->kode_unit,
            'nama_unit' => $value->nama_unit,
            'kode_sub_unit' => $value->kode_sub_unit,
            'nama_sub_unit' => $value->nama_sub_unit,
            'kode_upb' => $value->kode_upb,
            'nama_upb' => $value->nama_upb,
            'id_aset_b' => $value->id_aset_b,
            'nama_aset' => $value->nama_aset,
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
            'masa_manfaat' =>$value->masa_manfaat, 
            'nilai_sisa' =>$value->nilai_sisa,
            'keterangan'=>$value->keterangan, 
            'tahun' =>$value->tahun, 
            'no_sp2d' =>$value->no_sp2d, 
            'no_skguna' =>$value->no_skguna, 
            'kd_penyusutan' =>$value->kd_penyusutan, 
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
            'nilai_susut1' =>$value->nilai_susut1, 
            'nilai_susut2' =>$value->nilai_susut2, 
            'akum_susut' =>$value->akum_susut, 
            'sisa_umur' =>$value->sisa_umur, 
            'is_aset_yang_ditemukan' =>$value->is_aset_yang_ditemukan, 
            'no_reg8' =>$value->no_reg8, 
            'jenis_aset' =>$value->jenis_aset, 
            'kd_aset' =>$value->kd_aset, 
            'kd_aset0' =>$value->kd_aset0,
	
        ]);
    }
    return response()->json([
        'success' => true,
        'data' => $KibResponse
        // 'data'=>$unit[0]
    ], 200);
}


}
