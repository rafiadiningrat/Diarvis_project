<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetBModel;
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

    public function updatePenilaian(Request $request, $id)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
        ]);
    
        $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id);
    
        // if ($request->hasFile('dokumen_penilaian')) {
        //     if ($usulanB->dokumen_penilaian) {
        //         Storage::disk('public')->delete($usulanB->dokumen_penilaian);
        //     }
    
        //     $media = $usulanB->addMediaFromRequest('dokumen_penilaian')
        //         ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
    
        //     $usulanB->dokumen_penilaian = $media->getUrl();
        // } elseif ($request->filled('dokumen_penilaian')) {
        //     $usulanB->dokumen_penilaian = $request->dokumen_penilaian;
        // }
    
        // Memanggil fungsi updateFoto untuk memperbarui foto
        $usulanB->updateFoto($request->file('dokumen_penilaian'));
    
        // Menyimpan perubahan data ke dalam database
        $usulanB->save();
    
        return response()->json([
            'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diubah menjadi true.',
            'data' => $usulanB
        ]);
        }
}

