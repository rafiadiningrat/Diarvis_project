<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetE;
use App\Http\Resources\PengusulanPenghapusanAsetEResource;

class PenilaianPenghapusanAsetEController extends Controller
{
    //

    public function index($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
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

    public function getPenilaianByUpb($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $penilaian = PengusulanPenghapusanAsetE::whereNull('status_verifikasi')
                            ->whereNull('status_penilaian')
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

    public function addApprovePenilaianE(Request $request, $id_usulan_e)
    {

        $request->validate([
            'dokumen_penilaian' => 'required|mimetypes:application/pdf|max:2048',
            'keterangan_penilaian' => 'required|string',
        ]);

        $penilaianE = PengusulanPenghapusanAsetE::findOrFail($id_usulan_e);

        $penilaianE->status_penilaian = true;
        $penilaianE->keterangan_penilaian = $request->input('keterangan_penilaian');
        $penilaianE->penilaian_at = now();


        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $penilaianE->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetE::IMAGE_COLLECTION);
        
                 $penilaianE->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $penilaianE->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diterima',
                 'data' => $penilaianE
             ]);
}

public function addDeclinePenilaianE(Request $request, $id_usulan_e)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
            'keterangan_penilaian' => 'required|string',
        ]);

        $penilaianE = PengusulanPenghapusanAsetE::findOrFail($id_usulan_e);

        $penilaianE->status_penilaian = false;
        $penilaianE->keterangan_penilaian = $request->input('keterangan_penilaian');
        $penilaianE->penilaian_at = now();


        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $penilaianE->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetE::IMAGE_COLLECTION);
        
                 $penilaianE->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $penilaianE->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian ditolak.',
                 'data' => $penilaianE
             ]);
}

public function getDetailPenilaianE($id_usulan_e)
{
    $penilaian = PengusulanPenghapusanAsetE::where('id_usulan_e', $id_usulan_e)
                        ->with('kibE')
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

public function updatePenilaianE(Request $request, $id_usulan_e)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_e' => 'required|exists:kib_e,id_aset_e',
        'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
    ]);

    $usulanB = PengusulanPenghapusanAsetE::findOrFail($id_usulan_e);

    $usulanB->id_user = $request->input('id_user');
    $usulanB->id_aset_e = $request->input('id_aset_e');

    if ($request->hasFile('dokumen_penilaian')) {
        //$usulanB->clearMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $file1 = $request->file('dokumen_penilaian');
        $media1 = $usulanB->addMedia($file1)->toMediaCollection(PengusulanPenghapusanAsetE::IMAGE_COLLECTION);
        $usulanB->dokumen_penilaian = $media1->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Penilaian updated successfully',
        'usulan' => new PengusulanPenghapusanAsetEResource($usulanB)
    ], 200);
}
}