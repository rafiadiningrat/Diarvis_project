<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetEModel;

class VerifikasiPenghapusanAsetEController extends Controller
{
    //
    public function index()
    {
        $verifikasi = PengusulanPenghapusanAsetEModel::whereNull('status_verifikasi')
                                ->where('status_penilaian', true)
                                ->whereNull('status_penghapusan')
                                ->with('kibE')
                                ->get();

        return response()->json($verifikasi);
    }

    public function approve(Request $request, $id_usulan_e)
    {

        $usulanB = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        if ($usulanB->status_penilaian) {
            $usulanB->status_verifikasi = true;
            $usulanB->save();
    
            return response()->json([
                'message' => 'Usulan created successfully',
                'usulan' => $usulanB
            ], 201);
        } else {
            return response()->json([
                'message' => 'Masih dalam Penilaian',
            ], 400);
        }
    } 

    public function decline(Request $request, $id_usulan_e)
    {

        $usulanB = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        if ($usulanB->status_penilaian) {
            $usulanB->status_verifikasi = false;
            $usulanB->status_penghapusan = false;
            $usulanB->save();
    
            return response()->json([
                'message' => 'verifikasi ditolak',
                'usulan' => $usulanB
            ], 201);
        } else {
            return response()->json([
                'message' => 'Masih dalam Penilaian',
            ], 400);
        }
    } 
}
