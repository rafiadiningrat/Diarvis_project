<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $upb = UPBModel::where('kode_sub_unit', $kode_sub_unit)->get(['kode_upb','kode_sub_unit', 'nama_upb']);
        return $upb;
    }

    public function subUnits()
    {
        return $this->belongsTo(SubUnitModel::class);
    }
}
