<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengusulanPenghapusanAsetEModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use App\Http\Resources\PengusulanPenghapusanAsetEResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PengusulanPenghapusanAsetEController extends Controller
{
    //
    public function index()
{
    $pengusulan = PengusulanPenghapusanAsetEResource::collection(PengusulanPenghapusanAsetEModel::with('user', 'kibE')->get());

    return response()->json($pengusulan);
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_e' => 'required|exists:kib_e,id_aset_e',
        'foto_barang1' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang2' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang3' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang4' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'alasan_penghapusan' => 'required|string',
    ]);

    $usulanB = PengusulanPenghapusanAsetEModel::create([
        'id_user' => $validatedData['id_user'],
        'id_aset_e' => $validatedData['id_aset_e'],
        'alasan_penghapusan' => $validatedData['alasan_penghapusan'],
        'status_penghapusan' => false,
        'status_penilaian' => false,
        'status_verifikasi' => false,
        'dokumen_penilaian' => '',
    ]);


    if ($request->hasFile('foto_barang1')) {
        $media = $usulanB->addMedia($request->file('foto_barang1'))
            ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);

        $usulanB->foto_barang1 = $media->getUrl();
    }


    if ($request->hasFile('foto_barang2')) {
        $media = $usulanB->addMedia($request->file('foto_barang2'))
            ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);

        $usulanB->foto_barang2 = $media->getUrl();
    }

    if ($request->hasFile('foto_barang3')) {
        $media = $usulanB->addMedia($request->file('foto_barang3'))
            ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);

        $usulanB->foto_barang3 = $media->getUrl();
    }

    if ($request->hasFile('foto_barang4')) {
        $media = $usulanB->addMedia($request->file('foto_barang4'))
            ->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);

        $usulanB->foto_barang4 = $media->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Usulan created successfully',
        //'usulan' => $usulanB->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->toArray(),
        //'foto_barang1' => $fotoBarang1,
        'usulan' => new PengusulanPenghapusanAsetEResource($usulanB)
    ], 201);
}

public function update(Request $request, $id_usulan_b)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:USER,id_user',
        'id_aset_e' => 'required|exists:kib_e,id_aset_e',
        'foto_barang1' => 'image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang2' => 'image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang3' => 'image|mimes:jpeg,jpg,png|max:2048',
        'foto_barang4' => 'image|mimes:jpeg,jpg,png|max:2048',
        'alasan_penghapusan' => 'required|string',
    ]);

    $usulanB = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_b);

    $usulanB->id_user = $request->input('id_user');
    $usulanB->id_aset_e = $request->input('id_aset_e');
    $usulanB->alasan_penghapusan = $request->input('alasan_penghapusan');

    $usulanB->clearMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);

    if ($request->hasFile('foto_barang1')) {
        $file1 = $request->file('foto_barang1');
        $media1 = $usulanB->addMedia($file1)->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $usulanB->foto_barang1 = $media1->getUrl();
    }

    if ($request->hasFile('foto_barang2')) {
        $file2 = $request->file('foto_barang2');
        $media2 = $usulanB->addMedia($file2)->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $usulanB->foto_barang2 = $media2->getUrl();
    }

    if ($request->hasFile('foto_barang3')) {
        $file3 = $request->file('foto_barang3');
        $media3 = $usulanB->addMedia($file3)->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $usulanB->foto_barang3 = $media3->getUrl();
    }

    if ($request->hasFile('foto_barang4')) {
        $file4 = $request->file('foto_barang4');
        $media4 = $usulanB->addMedia($file4)->toMediaCollection(PengusulanPenghapusanAsetEModel::IMAGE_COLLECTION);
        $usulanB->foto_barang4 = $media4->getUrl();
    }

    $usulanB->save();

    return response()->json([
        'message' => 'Usulan updated successfully',
        'usulan' => new PengusulanPenghapusanAsetEResource($usulanB)
    ], 200);
}

public function destroy($id_usulan_e)
{
    $usulane = PengusulanPenghapusanAsetEModel::findOrFail($id_usulan_e);

    $usulane->delete();

    return response()->json([
        'message' => 'Usulan deleted successfully'
    ], 200);
}

public function detail($id_usulan_e)
{
    $usulanE = PengusulanPenghapusanAsetEModel::where('id_usulan_e', $id_usulan_e)->first();

    if (!$usulanE) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $usulanE
    ], 200);
}

public function getAllUsulanE()
    {
        $usulanE = PengusulanPenghapusanAsetEModel::get();
        return $usulanE;
    }

    public function getListUsulanE($id_user)
    {
        $usulanE = PengusulanPenghapusanAsetEModel::where('id_user',$id_user)->get();
        return response()->json([
            'success' => true,
            'data' => $usulanE,
            // 'data'=>$unit[0]
        ], 200);
    }
}
