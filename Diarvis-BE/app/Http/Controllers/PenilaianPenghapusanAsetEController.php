<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetEModel;
use App\Http\Resources\PengusulanPenghapusanAsetEResource;

class PenilaianPenghapusanAsetEController extends Controller
{
    //

    public function index()
    {
        $penilaian = PengusulanPenghapusanAsetEModel::whereNull('status_verifikasi')
                                ->whereNull('status_penilaian')
                                ->whereNull('status_penghapusan')
                                ->with('kibE')
                                ->get();

        return response()->json($penilaian);
    }

    public function approve(Request $request, $id_usulan_e)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
            'keterangan_penilaian' => 'required|string',
        ]);

        $penilaianE = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        $penilaianE->status_penilaian = true;
        $penilaianE->keterangan_penilaian = $request->input('keterangan_penilaian');

        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $penilaianE->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        
                 $penilaianE->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $penilaianE->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diterima',
                 'data' => $penilaianE
             ]);
}

public function decline(Request $request, $id_usulan_e)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
            'keterangan_penilaian' => 'required|string',
        ]);

        $penilaianE = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        $penilaianE->status_penilaian = false;
        $penilaianE->keterangan_penilaian = $request->input('keterangan_penilaian');

        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $penilaianE->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        
                 $penilaianE->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $penilaianE->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian ditolak.',
                 'data' => $penilaianE
             ]);
}

public function detailPenilaian($id_usulan_e)
{
    $penilaian = PengusulanPenghapusanAsetEModel::where('id_usulan_e', $id_usulan_e)
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

    $usulanB = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

    $usulanB->id_user = $request->input('id_user');
    $usulanB->id_aset_e = $request->input('id_aset_e');

    if ($request->hasFile('dokumen_penilaian')) {
        //$usulanB->clearMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $file1 = $request->file('dokumen_penilaian');
        $media1 = $usulanB->addMedia($file1)->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $usulanB->dokumen_penilaian = $media1->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Penilaian updated successfully',
        'usulan' => new PengusulanPenghapusanAsetEResource($usulanB)
    ], 200);
}
}