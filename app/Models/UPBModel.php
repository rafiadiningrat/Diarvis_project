<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidangModel;
use App\Models\UnitModel;
use App\Models\SubUnitModel;

class UPBModel extends Model
{
    use HasFactory;

    protected $table = 'upb';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAllUpb()
    {
        $upb = UPBModel::get(['kode_upb', 'nama_upb']);
        return $upb;
    }

    public function getUpb($kode_sub_unit)
    {
        $unit = UPBModel::with('bidang', 'unit', 'subUnit')->where('kode_sub_unit', $kode_sub_unit)->get();
        $UpbResponse = [];
        foreach ($unit as $value) {
            array_push($UpbResponse, [
                'kode_upb' => $value->kode_upb,
                'nama_bidang' => $value->bidang->nama_bidang,
                'nama_unit' => $value->unit->nama_unit,
                'nama_sub_unit' => $value->subUnit->nama_sub_unit,
                'nama_upb' => $value->nama_upb,
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $UpbResponse
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

    public function subUnit()
    {
        return $this->belongsTo(SubUnitModel::class, 'kode_sub_unit', 'kode_sub_unit');
    }

    public function kibB()
    {
        return $this->hasMany(KIBBModel::class);
    }

    public function kibE()
    {
        return $this->hasMany(KIBEModel::class);
    }
}
