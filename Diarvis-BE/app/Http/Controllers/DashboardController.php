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
        'Total Pengusulan' => PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get(),
        'Total Penilaian' => PengusulanPenghapusanAsetBModel::where('status_penilaian', true)->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get(),
        'Total Verifikasi' => PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->select('kib_b.kode_upb', DB::raw('count(*) as count'))
                                                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                                            ->groupBy('kib_b.kode_upb')
                                                            ->get(),
        'Total Penghapusan' => PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->select('kib_b.kode_upb', DB::raw('count(*) as count'))
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
            'Total Pengusulan' => PengusulanPenghapusanAsetEModel::query("SELECT * from pengusulan_penghapusan_aset_e")->count(),
            'Total Penilaian' => PengusulanPenghapusanAsetEModel::where('status_penilaian', true)->count(),
            'Total Verifikasi' => PengusulanPenghapusanAsetEModel::where('status_verifikasi', true)->count(),
            'Total Penghapusan' => PengusulanPenghapusanAsetEModel::where('status_penghapusan', true)->count()
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
