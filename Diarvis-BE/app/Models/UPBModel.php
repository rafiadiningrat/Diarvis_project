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

    public function getUpb($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
    {

        $unit = SubUnitModel::with('bidang', 'unit', 'subUnit')
        ->where('kode_bidang', $kode_bidang)
        ->where('kode_unit', $kode_unit)
        ->where('kode_sub_unit', $kode_sub_unit)->get();
        $subUnitResponse = [];
        foreach ($unit as $value) {
            array_push($subUnitResponse, [
                'kode_sub_unit' => $value->subUnit->kode_sub_unit,
                'kode_bidang' => $value->bidang->kode_bidang,
                'nama_bidang' => $value->bidang->nama_bidang,
                'kode_unit' => $value->unit->kode_unit,
                'nama_unit' => $value->unit->nama_unit,
                'nama_sub_unit' => $value->subUnit->nama_sub_unit,
                'kode_upb' => $value->kode_upb,
                'nama_upb' => $value->nama_upb,

            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $subUnitResponse
            // 'data'=>$unit[0]
        ], 200);

    //     $upb = UPBModel::join('sub_unit', function ($join) use ($kode_unit, $kode_sub_unit) {
    //         $join->on('upb.kode_sub_unit', '=', 'sub_unit.kode_sub_unit')
    //             ->where('sub_unit.kode_unit', '=', $kode_unit)
    //             ->where('sub_unit.kode_sub_unit', '=', $kode_sub_unit);
    //     })
    //     ->join('unit', function ($join) use ($kode_bidang) {
    //         $join->on('sub_unit.kode_unit', '=', 'unit.kode_unit')
    //             ->where('unit.kode_bidang', '=', $kode_bidang);
    //     })
    //     ->join('bidang', 'unit.kode_bidang', '=', 'bidang.kode_bidang')
    //     ->where('upb.kode_upb', '=', $kode_upb)
    //     ->select('upb.kode_upb', 'bidang.kode_bidang', 'bidang.nama_bidang', 'unit.kode_unit', 'unit.nama_unit', 'sub_unit.kode_sub_unit', 'sub_unit.nama_sub_unit', 'upb.nama_upb')
    //     ->get();

    // $UpbResponse = [];
    // foreach ($upb as $value) {
    //     array_push($UpbResponse, [
    //         'kode_upb' => $value->kode_upb,
    //         'kode_bidang' => $value->kode_bidang,
    //         'nama_bidang' => $value->nama_bidang,
    //         'kode_unit' => $value->kode_unit,
    //         'nama_unit' => $value->nama_unit,
    //         'kode_sub_unit' => $value->kode_sub_unit,
    //         'nama_sub_unit' => $value->nama_sub_unit,
    //         'nama_upb' => $value->nama_upb,
    //     ]);
    // }

    // return response()->json([
    //     'success' => true,
    //     'data' => $UpbResponse
    // ], 200);
    }

    //     $upb = UPBModel::join('sub_unit', 'upb.kode_sub_unit', '=', 'sub_unit.kode_sub_unit')
    //     ->join('unit', 'sub_unit.kode_unit', '=', 'unit.kode_unit')
    //     ->join('bidang', 'unit.kode_bidang', '=', 'bidang.kode_bidang')
    //     ->where('bidang.kode_bidang', $kode_bidang)
    //     ->where('unit.kode_unit', $kode_unit)
    //     ->where('sub_unit.kode_sub_unit', $kode_sub_unit)
    //     ->select('upb.kode_upb', 'bidang.kode_bidang', 'bidang.nama_bidang', 'unit.kode_unit', 'unit.nama_unit', 'sub_unit.kode_sub_unit', 'sub_unit.nama_sub_unit', 'upb.nama_upb')
    //     ->get();

    // $UpbResponse = [];
    // foreach ($upb as $value) {
    //     array_push($UpbResponse, [
    //         'kode_upb' => $value->kode_upb,
    //         'kode_bidang' => $value->kode_bidang,
    //         'nama_bidang' => $value->nama_bidang,
    //         'kode_unit' => $value->kode_unit,
    //         'nama_unit' => $value->nama_unit,
    //         'kode_sub_unit' => $value->kode_sub_unit,
    //         'nama_sub_unit' => $value->nama_sub_unit,
    //         'nama_upb' => $value->nama_upb,
    //     ]);
    // }

    // return response()->json([
    //     'success' => true,
    //     'data' => $UpbResponse
    // ], 200);


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

    public function user()
    {
        return $this->hasMany(UserModel::class);
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
