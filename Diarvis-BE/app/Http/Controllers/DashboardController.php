<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\KIBBModel;
use Illuminate\Support\Facades\DB;
use App\Models\PengusulanPenghapusanAsetBModel;
use App\Models\PengusulanPenghapusanAsetEModel;

class DashboardController extends Controller
{
    //
    public function dashboardB()
    {
        $status = true;
        $usulanBCount = [
        'total_pengusulan' => PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get(),
        'total_penilaian' => PengusulanPenghapusanAsetBModel::whereNotNull('status_penilaian')->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get(),
        'total_verifikasi' => PengusulanPenghapusanAsetBModel::whereNotNull('status_verifikasi')->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get(),
        'total_penghapusan' => PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get()
    ];

    // Mengambil jumlah berdasarkan kode_upb
    // $kodeUpbCounts = PengusulanPenghapusanAsetBModel::select('kib_b.kode_upb', DB::raw('count(*) as count'))
    //                     ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
    //                     ->groupBy('kib_b.kode_upb')
    //                     ->get();

    // foreach ($kodeUpbCounts as $kodeUpbCount) {
    //     $usulanBCount['Total ' . $kodeUpbCount->kode_upb] = $kodeUpbCount->count;
    // }

    return $usulanBCount;
    }
    
    public function dashboardE()
    {
        $status = true;
        $usulanECount = [
            'total_pengusulan' => PengusulanPenghapusanAsetEModel::query("SELECT * from pengusulan_penghapusan_aset_e")->select('kib_e.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                                                            ->groupBy('kib_e.kode_upb')
                                                            ->get(),
            'total_penilaian' => PengusulanPenghapusanAsetEModel::whereNotNull('status_penilaian')->select('kib_e.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                                                            ->groupBy('kib_e.kode_upb')
                                                            ->get(),
            'total_verifikasi' => PengusulanPenghapusanAsetEModel::whereNotNull('status_verifikasi')->select('kib_e.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                                                            ->groupBy('kib_e.kode_upb')
                                                            ->get(),
            'total_penghapusan' => PengusulanPenghapusanAsetEModel::where('status_penghapusan', true)->select('kib_e.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                                                            ->groupBy('kib_e.kode_upb')
                                                            ->get()
        ];
    
        return $usulanECount;
    }


    public function dashboardBE()
    {
       
        $status = true;
    
    $usulanBCount = PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->count();
    $usulanECount = PengusulanPenghapusanAsetEModel::query("SELECT * from pengusulan_penghapusan_aset_e")->count();
    
    $verifikasiBCount = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->count();
    $verifikasiECount = PengusulanPenghapusanAsetEModel::where('status_verifikasi', true)->count();
    
    $penilaianBCount = PengusulanPenghapusanAsetBModel::where('status_penilaian', true)->count();
    $penilaianECount = PengusulanPenghapusanAsetEModel::where('status_penilaian', true)->count();
    
    $penghapusanBCount = PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->count();
    $penghapusanECount = PengusulanPenghapusanAsetEModel::where('status_penghapusan', true)->count();
    
    $totalUsulanCount = $usulanBCount + $usulanECount;
    $totalVerifikasiCount = $verifikasiBCount + $verifikasiECount;
    $totalPenilaianCount = $penilaianBCount + $penilaianECount;
    $totalPenghapusanCount = $penghapusanBCount + $penghapusanECount;

    return [
        'Total Pengusulan' => $totalUsulanCount,
        'Total Penilaian' => $totalPenilaianCount,
        'Total Verifikasi' => $totalVerifikasiCount,
        'Total Penghapusan' => $totalPenghapusanCount
    ];
    }


    
}
