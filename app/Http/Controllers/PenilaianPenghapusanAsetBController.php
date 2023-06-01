<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetBModel;
use App\Http\Resources\PengusulanPenghapusanAsetBResource;
use Illuminate\Support\Facades\Storage;

class PenilaianPenghapusanAsetBController extends Controller
{
    public function index()
    {
        $penilaian = PengusulanPenghapusanAsetBModel::where('status_verifikasi', false)
                                ->where('status_penilaian', false)
                                ->where('status_penghapusan', false)
                                ->with('kibB')
                                ->get();

        return response()->json($penilaian);
    }

    public function prosesPenilaian(Request $request, $id)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
        ]);

        $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id);

        $usulanB->status_penilaian = true;

        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $usulanB->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
        
                 $usulanB->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $usulanB->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diubah menjadi true.',
                 'data' => $usulanB
             ]);
        // Mengunggah file PDF ke dalam storage
        // if ($request->hasFile('dokumen_penilaian')) {
        //     $file = $request->file('dokumen_penilaian');
        //     $path = $file->store('dokumen_penilaian', 'public');

        //     $usulanB->dokumen_penilaian = $path;

        //     return response()->json([
        //         'message' => 'File PDF berhasil diunggah.',
        //         'path' => $usulanB,
        //     ]);
        // }

        

        // return response()->json([
        //     'message' => 'Tidak ada file yang diunggah.',
        // ], 400);

            // $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id);
    
            // // Mengubah status_penilaian menjadi true
            // $usulanB->status_penilaian = true;
    
            // // Mengunggah file PDF ke dalam storage
            // if ($request->hasFile('dokumen_penilaian')) {
            //     $file = $request->file('dokumen_penilaian');
            //     $path = $file->store('dokumen_penilaian', 'public');
            //     $usulanB->dokumen_penilaian = $path;
            // }

            // if ($request->hasFile('dokumen_penilaian')) {
            //     $media = $usulanB->addMedia($request->file('dokumen_penilaian'))
            //         ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
        
            //     $usulanB->dokumen_penilaian = $media->getUrl();
            // }
    
            // // Menyimpan perubahan data ke dalam database
            // $usulanB->save();
    
            // return response()->json([
            //     'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diubah menjadi true.',
            //     'data' => $usulanB
            // ]);
        
    }

    public function updatePenilaianB(Request $request, $id_usulan_b)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_b' => 'required|exists:kib_b,id_aset_b',
        'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
    ]);

    $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

    $usulanB->id_user = $request->input('id_user');
    $usulanB->id_aset_b = $request->input('id_aset_b');

    if ($request->hasFile('dokumen_penilaian')) {
        //$usulanB->clearMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
        $file1 = $request->file('dokumen_penilaian');
        $media1 = $usulanB->addMedia($file1)->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
        $usulanB->dokumen_penilaian = $media1->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Penilaian updated successfully',
        'usulan' => new PengusulanPenghapusanAsetBResource($usulanB)
    ], 200);
}
}

