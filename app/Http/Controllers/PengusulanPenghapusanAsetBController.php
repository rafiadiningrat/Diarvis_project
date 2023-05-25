<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetBModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class PengusulanPenghapusanAsetBController extends Controller
{
    //
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_user' => 'required|exists:USER,id_user',
            'id_aset_b' => 'required|exists:kib_b,id_aset_b',
            'foto_barang1' => 'required|string',
            'foto_barang2' => 'required|string',
            'foto_barang3' => 'required|string',
            'foto_barang4' => 'required|string',
            'alasan_penghapusan' => 'required|string',
        ]);

        // if (!Auth::check()) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // // Mendapatkan pengguna terotentikasi
        // $user = Auth::user();

        // // Memastikan bahwa pengguna memiliki properti 'id'
        // if (!isset($user->id)) {
        //     return response()->json(['message' => 'Invalid user'], 400);
        // }

        $usulanB = PengusulanPenghapusanAsetBModel::create([
            'id_user' => $validatedData['id_user'],
            'id_aset_b' => $validatedData['id_aset_b'],
            'foto_barang1' => $validatedData['foto_barang1'],
            'foto_barang2' => $validatedData['foto_barang2'],
            'foto_barang3' => $validatedData['foto_barang3'],
            'foto_barang4' => $validatedData['foto_barang4'],
            'alasan_penghapusan' => $validatedData['alasan_penghapusan'],
            'status_penghapusan' => false,
            'status_penilaian' => false,
            'status_verifikasi' => false,
            'created_at' => Carbon::now(),
            //'created_by' => $user->id_user,
            'updated_at' => Carbon::now(),
            //'updated_by' => $user->id_user,
        ]);

        return response()->json([
            'message' => 'Usulan created successfully',
            'usulan' => $usulanB
        ], 201);

        // $id_usulan_b = $request->id_usulan_b;
        // $id_user = $request->id_user;
        // $id_aset_b = $request->id_aset_b;
        // // $foto_barang1 = $request->foto_barang1;
        // // $foto_barang2 = $request->foto_barang2;
        // // $foto_barang3 = $request->foto_barang3;
        // // $foto_barang4 = $request->foto_barang4;
        // // $alasan_penghapusan = $request->alasan_penghapusan;

        // $usulanB = PengusulanPenghapusanAsetBModel::create([
        //     'usulan_id' => $id_usulan_b,
        //     'id_user' => $id_user,
        //     'id_aset_b' => $id_aset_b,
        //     'status_penghapusan' => false,
        //     'status_penilaian' => false,
        //     'status_verifikasi' => false,
        // ]);

        // return response()->json([
        //     'message' => 'Usulan created successfully',
        //     'usulan' => $usulanB
        // ], 201);
    }

    public function update(Request $request, $id_usulan_b)
    {
        $id_user = $request->id_user;
        $id_aset_b = $request->id_aset_b;
        $foto_barang1 = $request->foto_barang1;
        $foto_barang2 = $request->foto_barang2;
        $foto_barang3 = $request->foto_barang3;
        $foto_barang4 = $request->foto_barang4;
        $alasan_penghapusan = $request->alasan_penghapusan;

        $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

        $usulanB->id_user = $id_user;
        $usulanB->id_aset_b = $id_aset_b;
        $usulanB->foto_barang1 = $foto_barang1;
        $usulanB->foto_barang2 = $foto_barang2;
        $usulanB->foto_barang3 = $foto_barang3;
        $usulanB->foto_barang4 = $foto_barang4;
        $usulanB->alasan_penghapusan = $alasan_penghapusan;

        $usulanB->save();

    return response()->json([
        'message' => 'Usulan updated successfully',
        'usulan' => $usulanB
    ], 200);
    } 
    
    public function destroy($id_usulan_b)
{
    $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

    $usulanB->delete();

    return response()->json([
        'message' => 'Usulan deleted successfully'
    ], 200);
}
}
