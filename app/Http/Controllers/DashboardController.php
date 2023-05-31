<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\KIBBModel;
use App\Models\PengusulanPenghapusanAsetBModel;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function verifikasi()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function penilaian()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_penilaian', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function penghapusan()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_penghapusan', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }
}
