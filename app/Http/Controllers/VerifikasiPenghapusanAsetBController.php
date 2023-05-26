<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetBModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class VerifikasiPenghapusanAsetBController extends Controller
{
    public function update(Request $request, $id_usulan_b)
    {
        // $id_user = $request->id_user;
        // $id_aset_b = $request->id_aset_b;
        // $foto_barang1 = $request->foto_barang1;
        // $foto_barang2 = $request->foto_barang2;
        // $foto_barang3 = $request->foto_barang3;
        // $foto_barang4 = $request->foto_barang4;
        // $alasan_penghapusan = $request->alasan_penghapusan;

        $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

        // $usulanB->id_user = $id_user;
        // $usulanB->id_aset_b = $id_aset_b;
        // $usulanB->foto_barang1 = $foto_barang1;
        // $usulanB->foto_barang2 = $foto_barang2;
        // $usulanB->foto_barang3 = $foto_barang3;
        // $usulanB->foto_barang4 = $foto_barang4;
        // $usulanB->alasan_penghapusan = $alasan_penghapusan;
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
}
