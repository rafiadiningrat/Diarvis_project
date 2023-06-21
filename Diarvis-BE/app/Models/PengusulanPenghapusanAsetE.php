<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\KIBE;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Resources\PengusulanPenghapusanAsetBResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class PengusulanPenghapusanAsetE extends Model implements HasMedia
{
    use HasFactory, HasTimestamps, InteractsWithMedia;

    protected $table = 'pengusulan_penghapusan_aset_e';
    protected $guarded = ['id'];
    protected $primaryKey = 'id_usulan_e';
    public $timestamps = true;
    protected $appends = ['foto'];
    protected $casts = [
        'update_at' => 'datetime',
    ];
    // protected $fillable = [
    //     'dokumen_penilaian',
    //     // Kolom lain yang diizinkan untuk diisi secara massal
    // ];

    const IMAGE_COLLECTION = 'product_images';
    const MIME_TYPES = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    const SIZES = [
        'extra_small' => [
            'h' => 480,
            'w' => 640,
        ],
        'small' => [
            'h' => 480,
            'w' => 720,
        ],
        'medium' => [
            'h' => 540,
            'w' => 960,
        ],
        'large' => [
            'h' => 720,
            'w' => 1280,
        ],
    ];

    /**
     * Get collection details.
     *
     * @return array
     */
    public function getCollectionDetails(): array
    {
        return [
            [
                'name' => self::IMAGE_COLLECTION,
                'is_single' => true,
                'mime_types' => self::MIME_TYPES,
                'sizes' => self::SIZES,
            ]
        ];
    }
    public function registerCollections(): void
    {
        $this->addCollections($this->getCollectionDetails());
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->registerCollections();
    }
     /**
     * Register media collections.
     *
     * @return void
     */
    // public function addCollections(array $collections): void
    // {
    //     foreach ($collections as $collection) {
    //         if ($collection['is_single']) {
    //             $this->addMediaCollection($collection['name'])
    //                 ->singleFile()
    //                 ->acceptsMimeTypes($collection['mime_types']);
    //             continue;
    //         }

    //         $this->addMediaCollection($collection['name'])
    //             ->acceptsMimeTypes($collection['mime_types']);
    //     }
    // }

    public function addCollections(array $collections): void
    {
        foreach ($collections as $collection) {
            $this->addMediaCollection($collection['name'])
                ->acceptsMimeTypes($collection['mime_types']);
        }
    }

    /**
     * Register media collections.
     *
     * @return void
     */

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')
            ->acceptsMimeTypes(['application/pdf'])
            ->singleFile();
    }

    // public function getImageAttribute()
    // {
    //     return $this->getFirstMediaUrl(self::IMAGE_COLLECTION);
    // }

    // public function getFotoBarang1Attribute()
    // {
    //     // return $this->getMedia(self::IMAGE_COLLECTION);
    //     $fotoBarang1Urls = [];
    //     $mediaItems = $this->getMedia(self::IMAGE_COLLECTION);
    
    //     foreach ($mediaItems as $media) {
    //     $fotoBarang1Urls[] = $media->getUrl();
    // }

    // return $fotoBarang1Urls;
    // }

    public function getFotoAttribute()
    {
        // return $this->getMedia(self::IMAGE_COLLECTION);
        $fotoBarang1Urls = [];
        $mediaItems = $this->getMedia(self::IMAGE_COLLECTION);
    
        foreach ($mediaItems as $media) {
        $fotoBarang1Urls[] = $media->getUrl();
    }

    return $fotoBarang1Urls;
    }

    public function updateFoto($fotoBaru)
{
    if (!is_array($fotoBaru)) {
        $fotoBaru = [$fotoBaru];
    }

    foreach ($fotoBaru as $foto) {
        if (!is_null($foto)) {
            $this->addMediaFromRequest('dokumen_penilaian', $foto)
                ->toMediaCollection(self::IMAGE_COLLECTION);
        }
    }

    //Hapus media lama jika ada
   $this->clearMediaCollectionExcept(self::IMAGE_COLLECTION, false);

    // Simpan perubahan ke dalam database
    $this->save();
}

//     public function getFotoBarang1Attribute()
// {
//     $media = $this->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->first(); // make ->first()
//     return $media ? $media->getUrl() : '';
// }

// public function getFotoBarang2Attribute()
// {
//     $media = $this->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->get(1);
//     return $media ? $media->getUrl() : '';
// }

// public function getFotoBarang3Attribute()
// {
//     $media = $this->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->get(2);
//     return $media ? $media->getUrl() : '';
// }

// public function getFotoBarang4Attribute()
// {
//     $media = $this->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->get(3);
//     return $media ? $media->getUrl() : '';
// }
    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('photos')
    //         ->useDisk('public')
    //         ->singleFile();
    // }

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumbnail')
    //         ->width(100)
    //         ->height(100);
    // }

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('foto')
    //         ->useDisk('public');
    // }
//     public function index()
// {
//     $pengusulan = PengusulanPenghapusanAsetBResource::collection(PengusulanPenghapusanAsetBModel::all());

//     return response()->json($pengusulan);
// }

//     public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'id_user' => 'required|exists:USER,id_user',
//         'id_aset_b' => 'required|exists:kib_b,id_aset_b',
//         'foto_barang1' => 'required|image|mimes:jpeg,jpg,png|max:2048',
//         'foto_barang2' => 'required|image|mimes:jpeg,jpg,png|max:2048',
//         'foto_barang3' => 'required|image|mimes:jpeg,jpg,png|max:2048',
//         'foto_barang4' => 'required|image|mimes:jpeg,jpg,png|max:2048',
//         'alasan_penghapusan' => 'required|string',
//     ]);

//     $usulanB = PengusulanPenghapusanAsetBModel::create([
//         'id_user' => $validatedData['id_user'],
//         'id_aset_b' => $validatedData['id_aset_b'],
//         'alasan_penghapusan' => $validatedData['alasan_penghapusan'],
//         'status_penghapusan' => false,
//         'status_penilaian' => false,
//         'status_verifikasi' => false,
//     ]);


//     // if ($request->hasFile('foto_barang1')) {
//     //     $fotoBarang1Urls = [];
//     //     foreach ($request->file('foto_barang1') as $foto_barang1) {
//     //         $media = $usulanB->addMedia($foto_barang1)
//     //             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);

//     //         $fotoBarang1Urls[] = $media->getUrl();
//     //     }

//     //     $usulanB->foto_barang1 = $fotoBarang1Urls;
//     // }

//     if ($request->hasFile('foto_barang1')) {
//         $media = $usulanB->addMedia($request->file('foto_barang1'))
//             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);

//         $usulanB->foto_barang1 = $media->getUrl();
//     }


//     if ($request->hasFile('foto_barang2')) {
//         $media = $usulanB->addMedia($request->file('foto_barang2'))
//             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);

//         $usulanB->foto_barang2 = $media->getUrl();
//     }

//     if ($request->hasFile('foto_barang3')) {
//         $media = $usulanB->addMedia($request->file('foto_barang3'))
//             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);

//         $usulanB->foto_barang3 = $media->getUrl();
//     }

//     if ($request->hasFile('foto_barang4')) {
//         $media = $usulanB->addMedia($request->file('foto_barang4'))
//             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);

//         $usulanB->foto_barang4 = $media->getUrl();
//     }

//     $usulanB->save();

//     // if (
//     //     $request->hasFile('foto_barang1') 
//     // ) {
//     //     $usulanB->clearMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//     //     foreach($request->file('foto_barang1') as $foto_barang1)
//     //     $usulanB->addMedia($foto_barang1)
//     //             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//     // }

//     // $fotoBarang1 = $usulanB->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)
//     //     ->map(function ($media) {
//     //         return $media->getUrl();
//     //     });

//     // if (
//     //     $request->hasFile('foto_barang1') 
//     // ) {
//     //     $usulanB->addMedia($request->file('foto_barang1'))
//     //             ->toMediaCollection(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION);
//     // }

//     // // Simpan foto_barang1
//     // $usulanB->addMediaFromRequest('foto_barang1')->toMediaCollection('foto');

//     // // Simpan foto_barang2
//     // $usulanB->addMediaFromRequest('foto_barang2')->toMediaCollection('foto');

//     // // Simpan foto_barang3
//     // $usulanB->addMediaFromRequest('foto_barang3')->toMediaCollection('foto');

//     // // Simpan foto_barang4
//     // $usulanB->addMediaFromRequest('foto_barang4')->toMediaCollection('foto');

//     return response()->json([
//         'message' => 'Usulan created successfully',
//         //'usulan' => $usulanB->getMedia(PengusulanPenghapusanAsetBModel::IMAGE_COLLECTION)->toArray(),
//         //'foto_barang1' => $fotoBarang1,
//         'usulan' => new PengusulanPenghapusanAsetBResource($usulanB)
//     ], 201);

//     // // Validasi data yang diterima
//     // $validatedData = $request->validate([
//     //     'id_user' => 'required|exists:users,id',
//     //     'id_aset_b' => 'required|exists:kib_b,id_aset_b',
//     //     'alasan_penghapusan' => 'required|string',
//     //     'foto_barang1' => 'required|string',
//     //     'foto_barang2' => 'required|string',
//     //     'foto_barang3' => 'required|string',
//     //     'foto_barang4' => 'required|string',
//     // ]);

//     // // Mendapatkan data file gambar yang dienkripsi dengan base64
//     // $fotoBarang1Data = $validatedData['foto_barang1'];
//     // $fotoBarang2Data = $validatedData['foto_barang2'];
//     // $fotoBarang3Data = $validatedData['foto_barang3'];
//     // $fotoBarang4Data = $validatedData['foto_barang4'];

//     // // Mendekode base64 menjadi file gambar
//     // $decodedFotoBarang1 = base64_decode($fotoBarang1Data);
//     // $decodedFotoBarang2 = base64_decode($fotoBarang2Data);
//     // $decodedFotoBarang3 = base64_decode($fotoBarang3Data);
//     // $decodedFotoBarang4 = base64_decode($fotoBarang4Data);

//     // // Membuat nama unik untuk file gambar
//     // $fotoBarang1Name = uniqid() . '.jpg';
//     // $fotoBarang2Name = uniqid() . '.jpg';
//     // $fotoBarang3Name = uniqid() . '.jpg';
//     // $fotoBarang4Name = uniqid() . '.jpg';

//     // // Menyimpan file gambar ke direktori tujuan
//     // $fotoBarang1Path = 'storage/app/public/foto/' . $fotoBarang1Name;
//     // $fotoBarang2Path = 'storage/app/public/foto/' . $fotoBarang2Name;
//     // $fotoBarang3Path = 'storage/app/public/foto/' . $fotoBarang3Name;
//     // $fotoBarang4Path = 'storage/app/public/foto/' . $fotoBarang4Name;

//     // file_put_contents($fotoBarang1Path, $decodedFotoBarang1);
//     // file_put_contents($fotoBarang2Path, $decodedFotoBarang2);
//     // file_put_contents($fotoBarang3Path, $decodedFotoBarang3);
//     // file_put_contents($fotoBarang4Path, $decodedFotoBarang4);

//     // // Membuat record usulan penghapusan dengan foto
//     // $usulanB = PengusulanPenghapusanAsetBModel::create([
//     //     'id_user' => $validatedData['id_user'],
//     //     'id_aset_b' => $validatedData['id_aset_b'],
//     //     'alasan_penghapusan' => $validatedData['alasan_penghapusan'],
//     //     'status_penghapusan' => false,
//     //     'status_penilaian' => false,
//     //     'status_verifikasi' => false,
//     //     'foto_barang1' => $fotoBarang1Name,
//     //     'foto_barang2' => $fotoBarang2Name,
//     //     'foto_barang3' => $fotoBarang3Name,
//     //     'foto_barang4' => $fotoBarang4Name,
//     // ]);

//     // return response()->json([
//     //     'message' => 'Usulan created successfully',
//     //     'usulan' => $usulanB
//     // ], 201);
// }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    public function kibE()
    {
        return $this->belongsTo(KIBE::class, 'id_aset_e', 'id_aset_e');
    }
}
