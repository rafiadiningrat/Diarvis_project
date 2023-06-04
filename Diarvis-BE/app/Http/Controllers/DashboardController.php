<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\KIBBModel;
use App\Models\PengusulanPenghapusanAsetBModel;
use App\Models\PengusulanPenghapusanAsetEModel;

class DashboardController extends Controller
{
    //
    public function dashboardB()
    {
        $status = true;
        $usulanBCount = [
            'Total Pengusulan' => PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->count(),
            'Total Penilaian' => PengusulanPenghapusanAsetBModel::where('status_penilaian', true)->count(),
            'Total Verifikasi' => PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->count(),
            'Total Penghapusan' => PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->count()
    ];

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
