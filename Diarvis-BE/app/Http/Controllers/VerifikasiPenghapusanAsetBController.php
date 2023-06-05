<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetBModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class VerifikasiPenghapusanAsetBController extends Controller
{
    public function index()
    {
        $verifikasi = PengusulanPenghapusanAsetBModel::where('status_penilaian', true)
                                 ->whereNull('status_verifikasi')
                                 ->whereNull('status_penghapusan')
                                ->with('kibB')
                                ->get();

        return response()->json($verifikasi);
    }

    public function approve(Request $request, $id_usulan_b)
    {

        $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

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

    public function decline(Request $request, $id_usulan_b)
    {

        $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

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

    public function detailVerifikasi($id_usulan_b)
{
    $penilaian = PengusulanPenghapusanAsetBModel::where('id_usulan_b', $id_usulan_b)
                        ->with('kibB')
                        ->first();

    if (!$penilaian) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $penilaian
    ], 200);
}

//     public function update(Request $request, $id_usulan_b)
// {
//     $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

//     if ($usulanB->status_penilaian) {
//         // Proses verifikasi
//         if ($request->has('status_verifikasi')) {
//             $status_verifikasi = $request->status_verifikasi;
//             $usulanB->status_verifikasi = $status_verifikasi;
//             $usulanB->save();

//             $verifikasiStatus = $status_verifikasi ? true : false;

//             return response()->json([
//                 'message' => 'Verifikasi successfully',
//                 'status_verifikasi' => $verifikasiStatus
//             ], 200);
//         } else {
//             return response()->json([
//                 'message' => 'Bad Request. Missing status_verifikasi field.'
//             ], 400);
//         }
//     } else {
//         return response()->json([
//             'message' => 'Masih dalam Penilaian',
//         ], 400);
//     }
// }
}
