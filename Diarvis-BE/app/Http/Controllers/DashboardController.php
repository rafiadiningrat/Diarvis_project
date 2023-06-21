<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\KIBB;
use Illuminate\Support\Facades\DB;
use App\Models\PengusulanPenghapusanAsetB;
use App\Models\PengusulanPenghapusanAsetE;

class DashboardController extends Controller
{
    //
    public function dashboardB($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $usulanBCount = [
            'total_pengusulan' => PengusulanPenghapusanAsetB::select(DB::raw('count(*) as count'))
                ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                ->where('kib_b.kode_bidang', $kode_bidang)
                ->where('kib_b.kode_unit', $kode_unit)
                ->where('kib_b.kode_sub_unit', $kode_sub_unit)
                ->where('kib_b.kode_upb', $kode_upb)
                ->groupBy('kib_b.kode_upb')
                ->count(),
    
            'total_penilaian' => PengusulanPenghapusanAsetB::select(DB::raw('count(*) as count'))
                ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                ->where('kib_b.kode_bidang', $kode_bidang)
                ->where('kib_b.kode_unit', $kode_unit)
                ->where('kib_b.kode_sub_unit', $kode_sub_unit)
                ->where('kib_b.kode_upb', $kode_upb)
                ->whereNotNull('pengusulan_penghapusan_aset_b.status_penilaian')
                ->groupBy('kib_b.kode_upb')
                ->count(),
    
            'total_verifikasi' => PengusulanPenghapusanAsetB::select(DB::raw('count(*) as count'))
                ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                ->where('kib_b.kode_bidang', $kode_bidang)
                ->where('kib_b.kode_unit', $kode_unit)
                ->where('kib_b.kode_sub_unit', $kode_sub_unit)
                ->where('kib_b.kode_upb', $kode_upb)
                ->whereNotNull('pengusulan_penghapusan_aset_b.status_verifikasi')
                ->groupBy('kib_b.kode_upb')
                ->count(),
    
            'total_penghapusan' => PengusulanPenghapusanAsetB::select(DB::raw('count(*) as count'))
                ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                ->where('kib_b.kode_bidang', $kode_bidang)
                ->where('kib_b.kode_unit', $kode_unit)
                ->where('kib_b.kode_sub_unit', $kode_sub_unit)
                ->where('kib_b.kode_upb', $kode_upb)
                ->where('pengusulan_penghapusan_aset_b.status_penghapusan', true)
                ->groupBy('kib_b.kode_upb')
                ->count()
        ];
    
        return response()->json($usulanBCount);
    }
    
    public function dashboardE($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {

        $usulanECount = [
            'total_pengusulan' => PengusulanPenghapusanAsetE::select(DB::raw('count(*) as count'))
                ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                ->where('kib_e.kode_bidang', $kode_bidang)
                ->where('kib_e.kode_unit', $kode_unit)
                ->where('kib_e.kode_sub_unit', $kode_sub_unit)
                ->where('kib_e.kode_upb', $kode_upb)
                ->groupBy('kib_e.kode_upb')
                ->count(),
    
            'total_penilaian' => PengusulanPenghapusanAsetE::select(DB::raw('count(*) as count'))
                ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                ->where('kib_e.kode_bidang', $kode_bidang)
                ->where('kib_e.kode_unit', $kode_unit)
                ->where('kib_e.kode_sub_unit', $kode_sub_unit)
                ->where('kib_e.kode_upb', $kode_upb)
                ->whereNotNull('pengusulan_penghapusan_aset_e.status_penilaian')
                ->groupBy('kib_e.kode_upb')
                ->count(),
    
            'total_verifikasi' => PengusulanPenghapusanAsetE::select(DB::raw('count(*) as count'))
                ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                ->where('kib_e.kode_bidang', $kode_bidang)
                ->where('kib_e.kode_unit', $kode_unit)
                ->where('kib_e.kode_sub_unit', $kode_sub_unit)
                ->where('kib_e.kode_upb', $kode_upb)
                ->whereNotNull('pengusulan_penghapusan_aset_e.status_verifikasi')
                ->groupBy('kib_e.kode_upb')
                ->count(),
    
            'total_penghapusan' => PengusulanPenghapusanAsetE::select(DB::raw('count(*) as count'))
                ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                ->where('kib_e.kode_bidang', $kode_bidang)
                ->where('kib_e.kode_unit', $kode_unit)
                ->where('kib_e.kode_sub_unit', $kode_sub_unit)
                ->where('kib_e.kode_upb', $kode_upb)
                ->where('pengusulan_penghapusan_aset_e.status_penghapusan', true)
                ->groupBy('kib_e.kode_upb')
                ->count()
        ];
    
        return response()->json($usulanECount);

        // $status = true;
        // $usulanECount = [
        //     'total_pengusulan' => PengusulanPenghapusanAsetEModel::query("SELECT * from pengusulan_penghapusan_aset_e")->select('kib_e.kode_upb', DB::raw('count(*) as count'))
        //                                                     ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
        //                                                     ->groupBy('kib_e.kode_upb')
        //                                                     ->get(),
        //     'total_penilaian' => PengusulanPenghapusanAsetEModel::whereNotNull('status_penilaian')->select('kib_e.kode_upb', DB::raw('count(*) as count'))
        //                                                     ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
        //                                                     ->groupBy('kib_e.kode_upb')
        //                                                     ->get(),
        //     'total_verifikasi' => PengusulanPenghapusanAsetEModel::whereNotNull('status_verifikasi')->select('kib_e.kode_upb', DB::raw('count(*) as count'))
        //                                                     ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
        //                                                     ->groupBy('kib_e.kode_upb')
        //                                                     ->get(),
        //     'total_penghapusan' => PengusulanPenghapusanAsetEModel::where('status_penghapusan', true)->select('kib_e.kode_upb', DB::raw('count(*) as count'))
        //                                                     ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
        //                                                     ->groupBy('kib_e.kode_upb')
        //                                                     ->get()
        // ];
    
        // return $usulanECount;
    }


    public function dashboardBE()
    {
       
        $status = true;
    
    $usulanBCount = PengusulanPenghapusanAsetB::query("SELECT * from pengusulan_penghapusan_aset_b")->count();
    $usulanECount = PengusulanPenghapusanAsetE::query("SELECT * from pengusulan_penghapusan_aset_e")->count();
    
    $verifikasiBCount = PengusulanPenghapusanAsetB::where('status_verifikasi', true)->count();
    $verifikasiECount = PengusulanPenghapusanAsetE::where('status_verifikasi', true)->count();
    
    $penilaianBCount = PengusulanPenghapusanAsetB::where('status_penilaian', true)->count();
    $penilaianECount = PengusulanPenghapusanAsetE::where('status_penilaian', true)->count();
    
    $penghapusanBCount = PengusulanPenghapusanAsetB::where('status_penghapusan', true)->count();
    $penghapusanECount = PengusulanPenghapusanAsetE::where('status_penghapusan', true)->count();
    
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
