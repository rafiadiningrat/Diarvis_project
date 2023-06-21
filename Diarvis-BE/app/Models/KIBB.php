<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bidang;
use App\Models\Unit;
use App\Models\SubUnit;
use App\Models\UPB;
use App\Models\Pemilik;

class KIBB extends Model
{

    use HasFactory;

    protected $table = 'kib_b';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function unit()
    {
        return $this->belongsTo(Unit::class, 'kode_unit', 'kode_unit');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'kode_bidang', 'kode_bidang');
    }

    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class, 'kode_sub_unit', 'kode_sub_unit');
    }

    public function upb()
    {
        return $this->belongsTo(UPB::class, 'kode_upb', 'kode_upb');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'kode_pemilik', 'kode_pemilik');
    }

    public function pengusulanB()
    {
        return $this->hasMany(PengusulanPenghapusanAsetB::class, 'id_usulan_b');
    }


}
