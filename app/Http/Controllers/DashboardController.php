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
        $usulanBCount = PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function verifikasiB()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function penilaianB()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_penilaian', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function penghapusanB()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function dashboardE()
    {
        $status = true;
        $usulanECount = PengusulanPenghapusanAsetEModel::query("SELECT * from pengusulan_penghapusan_aset_e")->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanECount;
    }

    public function verifikasiE()
    {
        $status = true;
        $usulanECount = PengusulanPenghapusanAsetEModel::where('status_verifikasi', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanECount;
    }

    public function penilaianE()
    {
        $status = true;
        $usulanECount = PengusulanPenghapusanAsetEModel::where('status_penilaian', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanECount;
    }

    public function penghapusanE()
    {
        $status = true;
        $usulanECount = PengusulanPenghapusanAsetEModel::where('status_penghapusan', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanECount;
    }

    public function dashboardBE()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->count();
        $usulanECount = PengusulanPenghapusanAsetEModel::query("SELECT * from pengusulan_penghapusan_aset_e")->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        $totalUsulanCount = $usulanBCount + $usulanECount;
        return $totalUsulanCount;
    }

    public function verifikasiBE()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->get()->count();
        $usulanECount = PengusulanPenghapusanAsetEModel::where('status_verifikasi', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        $totalUsulanCount = $usulanBCount + $usulanECount;
        return $totalUsulanCount;
    }

    public function penilaianBE()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_penilaian', true)->get()->count();
        $usulanECount = PengusulanPenghapusanAsetEModel::where('status_penilaian', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        $totalUsulanCount = $usulanBCount + $usulanECount;
        return $totalUsulanCount;
    }

    public function penghapusanBE()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->get()->count();
        $usulanECount = PengusulanPenghapusanAsetEModel::where('status_penghapusan', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        $totalUsulanCount = $usulanBCount + $usulanECount;
        return $totalUsulanCount;
    }
}
