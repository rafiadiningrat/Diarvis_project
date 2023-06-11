<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetBModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class VerifikasiPenghapusanAsetBController extends Controller
{
    public function index($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $verifikasi = PengusulanPenghapusanAsetBModel::whereNotNull('status_penilaian')
                                 ->whereNotNull('status_verifikasi')
                                 ->whereNotNull('status_penghapusan')
                                 ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                                 ->where('kib_b.kode_bidang', $kode_bidang)
                                 ->where('kib_b.kode_unit', $kode_unit)
                                 ->where('kib_b.kode_sub_unit', $kode_sub_unit)
                                 ->where('kib_b.kode_upb', $kode_upb)
                                 ->with('kibB')
                                ->get();

        return response()->json($verifikasi);
    }

    public function getVerifikasiByUpb($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $penilaian = PengusulanPenghapusanAsetBModel::whereNull('status_verifikasi')
                            ->whereNotNull('status_penilaian')
                            ->whereNull('status_penghapusan')
                            ->join('kib_b', 'pengusulan_penghapusan_aset_b.id_aset_b', '=', 'kib_b.id_aset_b')
                            ->where('kib_b.kode_bidang', $kode_bidang)
                            ->where('kib_b.kode_unit', $kode_unit)
                            ->where('kib_b.kode_sub_unit', $kode_sub_unit)
                            ->where('kib_b.kode_upb', $kode_upb)
                            ->with('kibB')
                            ->get();

    return response()->json($penilaian);
    }

    public function approve(Request $request, $id_usulan_b)
    {

        $request->validate([
            'keterangan_verifikasi' => 'required|string',
        ]);

        $verifikasiB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

        $verifikasiB->status_verifikasi = true;
        $verifikasiB->status_penghapusan = true;
        $verifikasiB->keterangan_verifikasi = $request->input('keterangan_verifikasi');
        $verifikasiB->verifikasi_at = now();

        $verifikasiB->save();
    
            return response()->json([
                'message' => 'verifikasi diterima',
                'usulan' => $verifikasiB
            ], 201);
    } 

    public function decline(Request $request, $id_usulan_b)
    {

        $request->validate([
            'keterangan_verifikasi' => 'required|string',
        ]);

        $verifikasiB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

        $verifikasiB->status_verifikasi = false;
        $verifikasiB->status_penghapusan = false;
        $verifikasiB->keterangan_verifikasi = $request->input('keterangan_verifikasi');
        $verifikasiB->verifikasi_at = now();

        $verifikasiB->save();
    
            return response()->json([
                'message' => 'Verifikasi ditolak',
                'usulan' => $verifikasiB
            ], 201);
        // $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

        // if ($usulanB->status_penilaian) {
        //     $usulanB->status_verifikasi = false;
        //     $usulanB->status_penghapusan = false;
        //     $usulanB->save();
    
        //     return response()->json([
        //         'message' => 'verifikasi ditolak',
        //         'usulan' => $usulanB
        //     ], 201);
        // } else {
        //     return response()->json([
        //         'message' => 'Masih dalam Penilaian',
        //     ], 400);
        // }
    } 

    public function detailVerifikasi($id_usulan_b)
{
    $verifikasi = PengusulanPenghapusanAsetBModel::where('id_usulan_b', $id_usulan_b)
                        ->with('kibB')
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
