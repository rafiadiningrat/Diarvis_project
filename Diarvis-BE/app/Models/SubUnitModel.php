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
        $unit = SubUnitModel::with('bidang', 'unit')->where('kode_unit', $kode_unit)->get();
        $subUnitResponse = [];
        foreach ($unit as $value) {
            array_push($subUnitResponse, [
                'kode_sub_unit' => $value->kode_sub_unit,
                'nama_bidang' => $value->bidang->nama_bidang,
                'nama_unit' => $value->unit->nama_unit,
                'nama_sub_unit' => $value->nama_sub_unit,
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $subUnitResponse
            // 'data'=>$unit[0]
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
