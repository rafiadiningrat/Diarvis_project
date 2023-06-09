<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengusulanPenghapusanAsetB;
use App\Models\KIBB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use App\Http\Controllers\Controller;
use App\Http\Resources\PengusulanPenghapusanAsetBResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PengusulanPenghapusanAsetBController extends Controller
{
   

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
   // }

public function index()
{
    $pengusulan = PengusulanPenghapusanAsetBResource::collection(PengusulanPenghapusanAsetB::with('user', 'kibB')->get());

    return response()->json($pengusulan);
}

    public function addUsulanB(Request $request)
{

    $idAsetB = $request->input('id_aset_b');
    $isAsetEUsed = PengusulanPenghapusanAsetB::where('id_aset_b', $idAsetB)->exists();

    if ($isAsetEUsed) {
        return response()->json([
            'message' => 'Aset Sudah diusulkan'
        ], 422);
    }

    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_b' => 'required|exists:kib_b,id_aset_b',
        'foto_barang1' => 'required|image|mimes:jpeg,jpg,png|max:8192',
        'foto_barang2' => 'required|image|mimes:jpeg,jpg,png|max:8192',
        'foto_barang3' => 'required|image|mimes:jpeg,jpg,png|max:8192',
        'foto_barang4' => 'required|image|mimes:jpeg,jpg,png|max:8192',
        'alasan_penghapusan' => 'required|string',
    ]);

    $usulanB = PengusulanPenghapusanAsetB::create([
        'id_user' => $validatedData['id_user'],
        'id_aset_b' => $validatedData['id_aset_b'],
        'alasan_penghapusan' => $validatedData['alasan_penghapusan'],
        // 'status_penghapusan' => false,
        // 'status_penilaian' => false,
        // 'status_verifikasi' => false,
        // 'dokumen_penilaian' => '',
    ]);


    if ($request->hasFile('foto_barang1')) {
        $media = $usulanB->addMedia($request->file('foto_barang1'))
            // ->usingFileName(Str::random(40))
            ->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);

        $usulanB->foto_barang1 = $media->getUrl();
    }


    if ($request->hasFile('foto_barang2')) {
        $media = $usulanB->addMedia($request->file('foto_barang2'))
            // ->usingFileName(Str::random(40))
            ->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);

        $usulanB->foto_barang2 = $media->getUrl();
    }

    if ($request->hasFile('foto_barang3')) {
        $media = $usulanB->addMedia($request->file('foto_barang3'))
            // ->usingFileName(Str::random(40))
            ->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);

        $usulanB->foto_barang3 = $media->getUrl();
    }

    if ($request->hasFile('foto_barang4')) {
        $media = $usulanB->addMedia($request->file('foto_barang4'))
            // ->usingFileName(Str::random(40))
            ->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);

        $usulanB->foto_barang4 = $media->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Usulan created successfully',
        //'usulan' => $usulanB->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->toArray(),
        //'foto_barang1' => $fotoBarang1,
        'usulan' => new PengusulanPenghapusanAsetBResource($usulanB)
    ], 201);
}

// public function update(Request $request, $id_usulan_b)
// {
//     // Validasi data
//     $validator = Validator::make($request->all(), [
//         'id_user' => 'required|exists:USER,id_user',
//         'id_aset_b' => 'required|exists:kib_b,id_aset_b',
//         'foto_barang1' => 'image|mimes:jpeg,jpg,png|max:2048',
//         'foto_barang2' => 'image|mimes:jpeg,jpg,png|max:2048',
//         'foto_barang3' => 'image|mimes:jpeg,jpg,png|max:2048',
//         'foto_barang4' => 'image|mimes:jpeg,jpg,png|max:2048',
//         'alasan_penghapusan' => 'required|string',
//     ]);

//     // Jika validasi gagal, kirimkan respon error
//     if ($validator->fails()) {
//         return response()->json([
//             'message' => 'Validasi gagal',
//             'errors' => $validator->errors(),
//         ], 422);
//     }

//     // Cari data usulan berdasarkan ID
//     $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

//     // Perbarui data usulan
//     $usulanB->id_user = $request->input('id_user');
//     $usulanB->id_aset_b = $request->input('id_aset_b');
//     $usulanB->alasan_penghapusan = $request->input('alasan_penghapusan');

//     // Perbarui foto_barang1 jika ada file yang diunggah
//     if ($request->hasFile('foto_barang1')) {
//         $file1 = $request->file('foto_barang1');
//         $fileName1 = $file1->getClientOriginalName();
//         $media1 = $usulanB->addMedia($file1)->usingName($fileName1)->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//         $usulanB->foto_barang1 = $media1->getUrl();
//     }

//     // Perbarui foto_barang2 jika ada file yang diunggah
//     if ($request->hasFile('foto_barang2')) {
//         $file2 = $request->file('foto_barang2');
//         $fileName2 = $file2->getClientOriginalName();
//         $media2 = $usulanB->addMedia($file2)->usingName($fileName2)->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//         $usulanB->foto_barang2 = $media2->getUrl();
//     }

//     // Perbarui foto_barang3 jika ada file yang diunggah
//     if ($request->hasFile('foto_barang3')) {
//         $file3 = $request->file('foto_barang3');
//         $fileName3 = $file3->getClientOriginalName();
//         $media3 = $usulanB->addMedia($file3)->usingName($fileName3)->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//         $usulanB->foto_barang3 = $media3->getUrl();
//     }

//     // Perbarui foto_barang4 jika ada file yang diunggah
//     if ($request->hasFile('foto_barang4')) {
//         $file4 = $request->file('foto_barang4');
//         $fileName4 = $file4->getClientOriginalName();
//         $media4 = $usulanB->addMedia($file4)->usingName($fileName4)->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//         $usulanB->foto_barang4 = $media4->getUrl();
//     }

//     // Simpan perubahan data usulan
//     $usulanB->save();
//     Log::info('Usulan B terupdate: ' . $usulanB);

//     // Kirim respon sukses
//     return response()->json([
//         'message' => 'Usulan berhasil diperbarui',
//         'usulan' => new PengusulanPenghapusanAsetBResource($usulanB)
//     ], 200);
// }

public function update(Request $request, $id_usulan_b)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_b' => 'required|exists:kib_b,id_aset_b',
        'foto_barang1' => 'image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang2' => 'image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang3' => 'image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang4' => 'image|mimes:jpeg,jpg,png|max:2048',
        'alasan_penghapusan' => 'required|string',
    ]);

    $usulanB = PengusulanPenghapusanAsetB::findOrFail($id_usulan_b);

    $usulanB->id_user = $request->input('id_user');
    $usulanB->id_aset_b = $request->input('id_aset_b');
    $usulanB->alasan_penghapusan = $request->input('alasan_penghapusan');

    $usulanB->clearMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);

    if ($request->hasFile('foto_barang1')) {
        $file1 = $request->file('foto_barang1');
        $media1 = $usulanB->addMedia($file1)->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        $usulanB->foto_barang1 = $media1->getUrl();
    }

    if ($request->hasFile('foto_barang2')) {
        $file2 = $request->file('foto_barang2');
        $media2 = $usulanB->addMedia($file2)->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        $usulanB->foto_barang2 = $media2->getUrl();
    }

    if ($request->hasFile('foto_barang3')) {
        $file3 = $request->file('foto_barang3');
        $media3 = $usulanB->addMedia($file3)->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        $usulanB->foto_barang3 = $media3->getUrl();
    }

    if ($request->hasFile('foto_barang4')) {
        $file4 = $request->file('foto_barang4');
        $media4 = $usulanB->addMedia($file4)->toMediaCollection(PengusulanPenghapusanAsetB::IMAGE_COLLECTION);
        $usulanB->foto_barang4 = $media4->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Usulan updated successfully',
        'usulan' => new PengusulanPenghapusanAsetBResource($usulanB)
    ], 200);
}





    // public function update(Request $request, $id_usulan_b)
    // {
    //     $id_user = $request->id_user;
    //     $id_aset_b = $request->id_aset_b;
    //     $foto_barang1 = $request->foto_barang1;
    //     $foto_barang2 = $request->foto_barang2;
    //     $foto_barang3 = $request->foto_barang3;
    //     $foto_barang4 = $request->foto_barang4;
    //     $alasan_penghapusan = $request->alasan_penghapusan;

    //     $usulanB = PengusulanPenghapusanAsetBModel::findOrFail($id_usulan_b);

    //     $usulanB->id_user = $id_user;
    //     $usulanB->id_aset_b = $id_aset_b;
    //     $usulanB->foto_barang1 = $foto_barang1;
    //     $usulanB->foto_barang2 = $foto_barang2;
    //     $usulanB->foto_barang3 = $foto_barang3;
    //     $usulanB->foto_barang4 = $foto_barang4;
    //     $usulanB->alasan_penghapusan = $alasan_penghapusan;

    //     $usulanB->save();

    // return response()->json([
    //     'message' => 'Usulan updated successfully',
    //     'usulan' => $usulanB
    // ], 200);
    // } 
    
public function destroy($id_usulan_b)
{
    $usulanB = PengusulanPenghapusanAsetB::findOrFail($id_usulan_b);

    $usulanB->delete();

    return response()->json([
        'message' => 'Usulan deleted successfully'
    ], 200);
}

public function getDetailUsulanB($id_usulan_b)
{
    $usulanB = PengusulanPenghapusanAsetB::where('id_usulan_b', $id_usulan_b)->first();

    if (!$usulanB) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $usulanB
    ], 200);
}

public function getBarangBelumUsulan($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
{
    $barangBelumUsulan = KIBB::whereNotExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('pengusulan_penghapusan_aset_b')
            ->whereRaw('pengusulan_penghapusan_aset_b.id_aset_b = kib_b.id_aset_b');
    })
    ->where('kib_b.kode_bidang', $kode_bidang)
    ->where('kib_b.kode_unit', $kode_unit)
    ->where('kib_b.kode_sub_unit', $kode_sub_unit)
    ->where('kib_b.kode_upb', $kode_upb)
    ->get();

    return response()->json([
        'success' => true,
        'data' => $barangBelumUsulan
    ]);
}

// public function getBarangBelumUsulan($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
// {
//     $barangBelumUsulan = KIBBModel::join('upb', 'kib_b.kode_upb', '=', 'upb.kode_upb')
//         ->join('sub_unit', 'upb.kode_sub_unit', '=', 'sub_unit.kode_sub_unit')
//         ->join('unit', 'sub_unit.kode_unit', '=', 'unit.kode_unit')
//         ->join('bidang', 'unit.kode_bidang', '=', 'bidang.kode_bidang')
//         ->whereNotExists(function ($query) {
//             $query->select(DB::raw(1))
//                 ->from('pengusulan_penghapusan_aset_b')
//                 ->whereRaw('pengusulan_penghapusan_aset_b.id_aset_b = kib_b.id_aset_b');
//         })
//         ->where('bidang.kode_bidang', '=', $kode_bidang)
//         ->where('unit.kode_unit', '=', $kode_unit)
//         ->where('sub_unit.kode_sub_unit', '=', $kode_sub_unit)
//         ->where('upb.kode_upb', '=', $kode_upb)
//         ->select('kib_b.*')
//         ->get();

//     return response()->json([
//         'success' => true,
//         'data' => $barangBelumUsulan
//     ]);
// }

public function getAllUsulanB()
    {
        $usulanB = PengusulanPenghapusanAsetB::get();
        return $usulanB;
    }

    public function getListUsulanB($id_user)
    {
        $usulanB = PengusulanPenghapusanAsetB::where('id_user',$id_user)->get();
        return response()->json([
            'success' => true,
            'data' => $usulanB,
            // 'data'=>$unit[0]
        ], 200);
    }
}
