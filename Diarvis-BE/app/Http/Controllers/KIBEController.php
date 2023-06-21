<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KIBEModel;
use App\Models\PengusulanPenghapusanAsetEModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KIBEExport;
use App\Exports\KIBECustomExport;

class KIBEController extends Controller
{
    //
    public function getAllKibE()
{
    $kib = KIBEModel::get();
    return $kib;
}

public function getDetailKibE($id_aset_e)
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

public function getKibE($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
{
    $kib =KIBEModel::join('bidang', 'kib_e.kode_bidang', '=', 'bidang.kode_bidang')
    ->join('unit', function ($join) {
        $join->on('kib_e.kode_bidang', '=', 'unit.kode_bidang')
            ->on('kib_e.kode_unit', '=', 'unit.kode_unit');
    })
    ->join('sub_unit', function ($join) {
        $join->on('kib_e.kode_bidang', '=', 'sub_unit.kode_bidang')
            ->on('kib_e.kode_unit', '=', 'sub_unit.kode_unit')
            ->on('kib_e.kode_sub_unit', '=', 'sub_unit.kode_sub_unit');
    })
    ->join('upb', function ($join) {
        $join->on('kib_e.kode_bidang', '=', 'upb.kode_bidang')
            ->on('kib_e.kode_unit', '=', 'upb.kode_unit')
            ->on('kib_e.kode_sub_unit', '=', 'upb.kode_sub_unit')
            ->on('kib_e.kode_upb', '=', 'upb.kode_upb');
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
                    'kib_e.*'
                )
                ->where('upb.kode_bidang', $kode_bidang)
                ->where('upb.kode_unit', $kode_unit)
                ->where('upb.kode_sub_unit', $kode_sub_unit)
                ->where('upb.kode_upb', $kode_upb)
                
                ->get();
    // $kib = KIBEModel::with('bidang', 'unit', 'subUnit', 'upb')
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
            'id_aset_e' => $value->id_aset_e,
            'nama_aset' => $value->nama_aset,
            'kode_pemilik' => $value->kode_pemilik,
            'kode_jenis_aset' => $value->kode_jenis_aset,
            'tgl_perolehan' => $value->tgl_perolehan,
            'judul' => $value->judul,
            'pencipta' => $value->pencipta,
            'bahan' => $value->bahan,
            'ukuran' => $value->ukuran,
            'asal_usul' => $value->asal_usul,
            'kondisi' => $value->kondisi,
            'harga' =>$value->harag, 
            'masa_manfaat' =>$value->masa_manfaat,
            'nila_sisa'=>$value->nilai_sisa, 
            'keterangan' =>$value->keterangan, 
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
            'jumlah' =>$value->akum_susut, 
            'sisa_umur' =>$value->jumlah, 
            'is_aset_yang_ditemukan' =>$value->is_aset_yang_ditemukan, 
            'no_reg8' =>$value->no_reg8,
	
        ]);
    }

    return response()->json([
        'success' => true,
        'data' => $KibResponse
    ], 200);
    }
    


public function getExportToExcel($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
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

    $export = new KIBEExport($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb);
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

public function getExportData($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
{
    $data = PengusulanPenghapusanAsetEModel::whereNotNull('status_penghapusan')
    ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
    ->where('kib_e.kode_bidang', $kode_bidang)
    ->where('kib_e.kode_unit', $kode_unit)
    ->where('kib_e.kode_sub_unit', $kode_sub_unit)
    ->where('kib_e.kode_upb', $kode_upb)
    ->select(
        'kib_e.id_aset_e',
        'kib_e.no_reg8',
        'kib_e.judul',
        'kib_e.pencipta',
        'kib_e.bahan',
        'kib_e.ukuran',
        'kib_e.jumlah',
        'kib_e.asal_usul',
        'kib_e.tahun',
        'kib_e.kondisi',
        'kib_e.harga',
        'kib_e.keterangan',
        // 'kib_e.sisa_umur',
        'pengusulan_penghapusan_aset_e.status_penghapusan',
        'pengusulan_penghapusan_aset_e.keterangan_verifikasi',
    )
    ->get()
    ->map(function ($item) {
        $item->status_penghapusan = $item->status_penghapusan ? 'Diterima' : 'Ditolak';
        return $item;
    });

    // $dataWithCustomColumn = $data->map(function ($item) {
    //     $item['Nomor'] = $item->nomor_pabrik . ' - ' . $item->nomor_rangka . ' - ' . $item->nomor_mesin . ' - ' . $item->nomor_polisi . ' - ' . $item->nomor_bpkb;
    //     return $item;
    // });

        $export = new KIBECustomExport($data);

        return Excel::download($export, 'penghapusan_aset_e_report.xlsx');;
}
}
