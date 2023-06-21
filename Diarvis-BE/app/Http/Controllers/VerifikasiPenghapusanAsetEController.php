<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetE;

class VerifikasiPenghapusanAsetEController extends Controller
{
    //
    public function index($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $verifikasi = PengusulanPenghapusanAsetE::whereNotNull('status_verifikasi')
                                ->whereNotNull('status_penilaian')
                                ->whereNotNull('status_penghapusan')
                                ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                                ->where('kib_e.kode_bidang', $kode_bidang)
                                ->where('kib_e.kode_unit', $kode_unit)
                                ->where('kib_e.kode_sub_unit', $kode_sub_unit)
                                ->where('kib_e.kode_upb', $kode_upb)
                                ->with('kibE')
                                ->get();

        return response()->json($verifikasi);
    }

    public function getVerifikasiByUpb($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $penilaian = PengusulanPenghapusanAsetE::whereNull('status_verifikasi')
                            ->whereNotNull('status_penilaian')
                            ->whereNull('status_penghapusan')
                            ->join('kib_e', 'pengusulan_penghapusan_aset_e.id_aset_e', '=', 'kib_e.id_aset_e')
                            ->where('kib_e.kode_bidang', $kode_bidang)
                            ->where('kib_e.kode_unit', $kode_unit)
                            ->where('kib_e.kode_sub_unit', $kode_sub_unit)
                            ->where('kib_e.kode_upb', $kode_upb)
                            ->with('kibE')
                            ->get();

    return response()->json($penilaian);
    }

    public function addApproveVerifikasiE(Request $request, $id_usulan_e)
    {

        $request->validate([
            'keterangan_verifikasi' => 'required|string',
        ]);

        $verifikasiE = PengusulanPenghapusanAsetE::findOrFail($id_usulan_e);

        $verifikasiE->status_verifikasi = true;
        $verifikasiE->status_penghapusan = true;
        $verifikasiE->keterangan_verifikasi = $request->input('keterangan_verifikasi');
        $verifikasiE->verifikasi_at = now();

        $verifikasiE->save();
    
            return response()->json([
                'message' => 'verifikasi diterima',
                'usulan' => $verifikasiE
            ], 201);
    } 

    public function addDeclineVerifikasiE(Request $request, $id_usulan_e)
    {

        $request->validate([
            'keterangan_verifikasi' => 'required|string',
        ]);

        $verifikasiE = PengusulanPenghapusanAsetE::findOrFail($id_usulan_e);

        $verifikasiE->status_verifikasi = false;
        $verifikasiE->status_penghapusan = false;
        $verifikasiE->keterangan_verifikasi = $request->input('keterangan_verifikasi');
        $verifikasiE->verifikasi_at = now();

        $verifikasiE->save();
    
            return response()->json([
                'message' => 'Verifikasi ditolak',
                'usulan' => $verifikasiE
            ], 201);
    } 

    public function getDetailVerifikasiE($id_usulan_e)
{
    $verifikasi = PengusulanPenghapusanAsetE::where('id_usulan_e', $id_usulan_e)
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
