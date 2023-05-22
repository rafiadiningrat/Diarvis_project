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

    public function getAllSubUnit()
    {
        $sub_unit = SubUnitModel::all();
        return $sub_unit;
    }

    public function getSubUnit($kode_unit)
    {
        $sub_unit = SubUnitModel::with('bidang','unit')->where('kode_unit', $kode_unit)->get();
        return response()->json([
            'success' => true,
            'data' => $sub_unit,
        ], 200);
        
    }

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
