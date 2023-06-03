<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetEModel;

class VerifikasiPenghapusanAsetEController extends Controller
{
    //
    public function index()
    {
        $verifikasi = PengusulanPenghapusanAsetEModel::where('status_verifikasi', false)
                                ->where('status_penilaian', true)
                                ->where('status_penghapusan', false)
                                ->with('kibE')
                                ->get();

        return response()->json($verifikasi);
    }

    public function update(Request $request, $id_usulan_e)
    {
        // $id_user = $request->id_user;
        // $id_aset_b = $request->id_aset_b;
        // $foto_barang1 = $request->foto_barang1;
        // $foto_barang2 = $request->foto_barang2;
        // $foto_barang3 = $request->foto_barang3;
        // $foto_barang4 = $request->foto_barang4;
        // $alasan_penghapusan = $request->alasan_penghapusan;

        $usulanE = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        // $usulanB->id_user = $id_user;
        // $usulanB->id_aset_b = $id_aset_b;
        // $usulanB->foto_barang1 = $foto_barang1;
        // $usulanB->foto_barang2 = $foto_barang2;
        // $usulanB->foto_barang3 = $foto_barang3;
        // $usulanB->foto_barang4 = $foto_barang4;
        // $usulanB->alasan_penghapusan = $alasan_penghapusan;
        if ($usulanE->status_penilaian) {
            $usulanE->status_verifikasi = true;
            $usulanE->save();
    
            return response()->json([
                'message' => 'Usulan created successfully',
                'usulan' => $usulanE
            ], 201);
        } else {
            return response()->json([
                'message' => 'Masih dalam Penilaian',
            ], 400);
        }
    } 
}
