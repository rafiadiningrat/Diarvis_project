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

        $request->validate([
            'keterangan_verifikasi' => 'required|string',
        ]);

        $verifikasiE = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        $verifikasiE->status_verifikasi = true;
        $verifikasiE->status_penghapusan = true;
        $verifikasiE->keterangan_verifikasi = $request->input('keterangan_verifikasi');

        $verifikasiE->save();
    
            return response()->json([
                'message' => 'verifikasi diterima',
                'usulan' => $verifikasiE
            ], 201);
    } 

    public function decline(Request $request, $id_usulan_e)
    {

        $request->validate([
            'keterangan_verifikasi' => 'required|string',
        ]);

        $verifikasiE = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        $verifikasiE->status_verifikasi = false;
        $verifikasiE->status_penghapusan = false;
        $verifikasiE->keterangan_verifikasi = $request->input('keterangan_verifikasi');

        $verifikasiE->save();
    
            return response()->json([
                'message' => 'Verifikasi ditolak',
                'usulan' => $verifikasiE
            ], 201);
    } 

    public function detailVerifikasi($id_usulan_e)
{
    $verifikasi = PengusulanPenghapusanAsetEModel::where('id_usulan_e', $id_usulan_e)
                        ->with('kibE')
                        ->first();

    if (!$verifikasi) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $verifikasi
    ], 200);
}
}
