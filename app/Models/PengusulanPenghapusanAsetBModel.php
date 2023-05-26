<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\KIBBModel;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PengusulanPenghapusanAsetBModel extends Model implements HasMedia
{
    use HasFactory, HasTimestamps, InteractsWithMedia;

    protected $table = 'pengusulan_penghapusan_aset_b';
    protected $guarded = ['id'];
    protected $primaryKey = 'id_usulan_b';
    public $timestamps = true;
    protected $casts = [
        'update_at' => 'datetime',
    ];

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('photos')
    //         ->useDisk('public')
    //         ->singleFile();
    // }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(100)
            ->height(100);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto_barang');
    }

    public function store(Request $request)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'id_user' => 'required|exists:users,id',
        'id_aset_b' => 'required|exists:kib_b,id_aset_b',
        'alasan_penghapusan' => 'required|string',
        'foto_barang1' => 'required|string',
        'foto_barang2' => 'required|string',
        'foto_barang3' => 'required|string',
        'foto_barang4' => 'required|string',
    ]);

    // Mendapatkan data file gambar yang dienkripsi dengan base64
    $fotoBarang1Data = $validatedData['foto_barang1'];
    $fotoBarang2Data = $validatedData['foto_barang2'];
    $fotoBarang3Data = $validatedData['foto_barang3'];
    $fotoBarang4Data = $validatedData['foto_barang4'];

    // Mendekode base64 menjadi file gambar
    $decodedFotoBarang1 = base64_decode($fotoBarang1Data);
    $decodedFotoBarang2 = base64_decode($fotoBarang2Data);
    $decodedFotoBarang3 = base64_decode($fotoBarang3Data);
    $decodedFotoBarang4 = base64_decode($fotoBarang4Data);

    // Membuat nama unik untuk file gambar
    $fotoBarang1Name = uniqid() . '.jpg';
    $fotoBarang2Name = uniqid() . '.jpg';
    $fotoBarang3Name = uniqid() . '.jpg';
    $fotoBarang4Name = uniqid() . '.jpg';

    // Menyimpan file gambar ke direktori tujuan
    $fotoBarang1Path = 'storage/app/public/foto/' . $fotoBarang1Name;
    $fotoBarang2Path = 'storage/app/public/foto/' . $fotoBarang2Name;
    $fotoBarang3Path = 'storage/app/public/foto/' . $fotoBarang3Name;
    $fotoBarang4Path = 'storage/app/public/foto/' . $fotoBarang4Name;

    file_put_contents($fotoBarang1Path, $decodedFotoBarang1);
    file_put_contents($fotoBarang2Path, $decodedFotoBarang2);
    file_put_contents($fotoBarang3Path, $decodedFotoBarang3);
    file_put_contents($fotoBarang4Path, $decodedFotoBarang4);

    // Membuat record usulan penghapusan dengan foto
    $usulanB = PengusulanPenghapusanAsetBModel::create([
        'id_user' => $validatedData['id_user'],
        'id_aset_b' => $validatedData['id_aset_b'],
        'alasan_penghapusan' => $validatedData['alasan_penghapusan'],
        'status_penghapusan' => false,
        'status_penilaian' => false,
        'status_verifikasi' => false,
        'foto_barang1' => $fotoBarang1Name,
        'foto_barang2' => $fotoBarang2Name,
        'foto_barang3' => $fotoBarang3Name,
        'foto_barang4' => $fotoBarang4Name,
    ]);

    return response()->json([
        'message' => 'Usulan created successfully',
        'usulan' => $usulanB
    ], 201);
}

    public function dashboard()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::query("SELECT * from pengusulan_penghapusan_aset_b")->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function verifikasi()
    {
        $status = true;
        $usulanBCount = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->get()->count();
        // return response()->json(['usulan_count' => $usulanBCount]);
        return $usulanBCount;
    }

    public function getAllUsulanB()
    {
        $usulanB = PengusulanPenghapusanAsetBModel::get();
        return $usulanB;
    }

    public function getListUsulanB($id_user)
    {
        $usulanB = PengusulanPenghapusanAsetBModel::where('id_user',$id_user)->get();
        return response()->json([
            'success' => true,
            'data' => $usulanB,
            // 'data'=>$unit[0]
        ], 200);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    public function kibB()
    {
        return $this->belongsTo(KIBBModel::class, 'id_aset_b', 'id_aset_b');
    }

    // public function createdBy()
    // {
    //     return $this->belongsTo(UserModel::class, 'created_by');
    // }

    // public function updatedBy()
    // {
    //     return $this->belongsTo(UserModel::class, 'update_by');
    // }
}
