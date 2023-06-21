<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bidang;
use App\Models\Unit;
use App\Models\SubUnit;

class UPB extends Model
{
    use HasFactory;

    protected $table = 'upb';
    protected $guarded = ['id'];
    public $timestamps = false;

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

    public function user()
    {
        return $this->hasMany(UserModel::class);
    }

    public function kibB()
    {
        return $this->hasMany(KIBB::class);
    }

    public function kibE()
    {
        return $this->hasMany(KIBE::class);
    }
}
