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
use App\Http\Resources\PengusulanPenghapusanAsetBResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class PengusulanPenghapusanAsetBModel extends Model implements HasMedia
{
    use HasFactory, HasTimestamps, InteractsWithMedia;

    protected $table = 'pengusulan_penghapusan_aset_b';
    protected $guarded = ['id'];
    protected $primaryKey = 'id_usulan_b';
    public $timestamps = true;
    protected $appends = ['foto'];
    protected $casts = [
        'update_at' => 'datetime',
    ];
    // protected $fillable = [
    //     'dokumen_penilaian',
        
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

    // Hapus media lama jika ada
   // $this->clearMediaCollectionExcept(self::IMAGE_COLLECTION, false);

    // Simpan perubahan ke dalam database
    $this->save();
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
