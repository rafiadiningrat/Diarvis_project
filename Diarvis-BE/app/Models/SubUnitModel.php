<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidangModel;
use App\Models\UnitModel;

class SubUnitModel extends Model
{
    use HasFactory;

    protected $table = 'sub_unit';
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

    public function upb()
    {
        return $this->hasMany(UPBModel::class);
    }
}

