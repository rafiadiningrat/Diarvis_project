<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidangModel;
use App\Models\UnitModel;
use App\Models\SubUnitModel;
use App\Models\UPBModel;
use App\Models\PemilikModel;

class KIBBModel extends Model
{

    use HasFactory;

    protected $table = 'kib_b';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function unit()
    {
        return $this->belongsTo(UnitModel::class, 'kode_unit', 'kode_unit');
    }

    public function bidang()
    {
        return $this->belongsTo(BidangModel::class, 'kode_bidang', 'kode_bidang');
    }

    public function subUnit()
    {
        return $this->belongsTo(SubUnitModel::class, 'kode_sub_unit', 'kode_sub_unit');
    }

    public function upb()
    {
        return $this->belongsTo(UPBModel::class, 'kode_upb', 'kode_upb');
    }

    public function pemilik()
    {
        return $this->belongsTo(PemilikModel::class, 'kode_pemilik', 'kode_pemilik');
    }

    public function pengusulanB()
    {
        return $this->hasMany(PengusulanPenghapusanAsetBModel::class, 'id_usulan_b');
    }


}
