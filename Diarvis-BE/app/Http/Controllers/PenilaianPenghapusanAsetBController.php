<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengusulanPenghapusanAsetB;
use App\Http\Resources\PengusulanPenghapusanAsetBResource;
use Illuminate\Support\Facades\Storage;

class PenilaianPenghapusanAsetBController extends Controller
{
    // public function index()
    // {
    //     $penilaian = PengusulanPenghapusanAsetBModel::where('status_verifikasi', false)
    //                             ->where('status_penilaian', false)
    //                             ->where('status_penghapusan', false)
    //                             ->with('kibB')
    //                             ->get();

    //     return response()->json($penilaian);
    // }

    public function index($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $penilaian = PengusulanPenghapusanAsetB::whereNull('status_verifikasi')
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

    public function getPenilaianbyUpbB($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {
        $penilaian = PengusulanPenghapusanAsetB::whereNull('status_verifikasi')
                            ->whereNull('status_penilaian')
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

    public function addApprovePenilaianB(Request $request, $id_usulan_b)
    {


        $request->validate([
            'dokumen_penilaian' => 'required|mimetypes:application/pdf|max:2048',
            'keterangan_penilaian' => 'required|string',
        ]);


        $penilaianB = PengusulanPenghapusanAsetB::findOrFail($id_usulan_b);

        $penilaianB->status_penilaian = true;
        $penilaianB->keterangan_penilaian = $request->input('keterangan_penilaian');
        $penilaianB->penilaian_at = now();

    
        // $media = $penilaianB->addMedia($request->file('dokumen_penilaian'))
        //     ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
    
        // $penilaianB->dokumen_penilaian = $media->getUrl();

        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $penilaianB->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        
                 $penilaianB->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $penilaianB->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian diterima',
                 'data' => $penilaianB
             ]);
        
    }

    public function addDeclinePenilaianB(Request $request, $id)
    {

        $request->validate([
            'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
            'keterangan_penilaian' => 'required|string',
        ]);

        $penilaianB = PengusulanPenghapusanAsetB::findOrFail($id);

        $penilaianB->status_penilaian = false;
        $penilaianB->keterangan_penilaian = $request->input('keterangan_penilaian');
        $penilaianB->penilaian_at = now();


        if ($request->hasFile('dokumen_penilaian')) {
                 $media = $penilaianB->addMedia($request->file('dokumen_penilaian'))
                     ->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        
                 $penilaianB->dokumen_penilaian = $media->getUrl();
             }
    
             // Menyimpan perubahan data ke dalam database
             $penilaianB->save();
    
             return response()->json([
                 'message' => 'Dokumen penilaian berhasil ditambahkan dan status penilaian ditolak.',
                 'data' => $penilaianB
             ]);
        
    }

//     public function prosesPenilaian(Request $request, $id)
// {
//     $request->validate([
//         'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
//         'status_penilaian' => 'boolean'
//     ]);

//     $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id);

//     if ($request->hasFile('dokumen_penilaian')) {
//         $media = $usulanB->addMedia($request->file('dokumen_penilaian'))
//             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);

//         $usulanB->dokumen_penilaian = $media->getUrl();
//     }

//     if ($request->has('status_penilaian')) {
//         $status_penilaian = $request->input('status_penilaian');

//         $usulanB->fill(['status_penilaian' => $status_penilaian]);

//         $verifikasiStatus = $status_penilaian ? true : false;

//         return response()->json([
//             'message' => 'Dokumen penilaian berhasil ditambahkan',
//             'data' => $usulanB,
//             'status_verifikasi' => $verifikasiStatus
//         ]);
//     } else {
//         return response()->json([
//             'message' => 'Bad Request. Missing status_penilaian field.'
//         ], 400);
//     }
// }
public function getDetailPenilaianB($id_usulan_b)
{
    $penilaian = PengusulanPenghapusanAsetB::where('id_usulan_b', $id_usulan_b)
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

    public function updatePenilaianB(Request $request, $id_usulan_b)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_b' => 'required|exists:kib_b,id_aset_b',
        'dokumen_penilaian' => 'mimetypes:application/pdf|max:2048',
    ]);

    $usulanB = PengusulanPenghapusanAsetB::findOrFail($id_usulan_b);

    $usulanB->id_user = $request->input('id_user');
    $usulanB->id_aset_b = $request->input('id_aset_b');

    if ($request->hasFile('dokumen_penilaian')) {
        //$usulanB->clearMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
        $file1 = $request->file('dokumen_penilaian');
        $media1 = $usulanB->addMedia($file1)->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        $usulanB->dokumen_penilaian = $media1->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Penilaian updated successfully',
        'usulan' => new PengusulanPenghapusanAsetBResource($usulanB)
    ], 200);
}
}

