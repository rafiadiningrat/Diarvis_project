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
        $penilaian = PengusulanPenghapusanAsetEModel::where('status_verifikasi', false)
                                ->where('status_penilaian', false)
                                ->where('status_penghapusan', false)
                                ->with('kibE')
                                ->get();

        return response()->json($penilaian);
    }

    public function prosesPenilaianE(Request $request, $id_usulan_e)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
        ]);

        $usulanB = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

        $usulanB->status_penilaian = true;

        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $usulanB->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        
                 $usulanB->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $usulanB->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diubah menjadi true.',
                 'data' => $usulanB
             ]);
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