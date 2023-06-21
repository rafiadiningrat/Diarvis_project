<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bidang;
use App\Models\Unit;

class SubUnit extends Model
{
    use HasFactory;

    protected $table = 'sub_unit';
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

    public function upb()
    {
        return $this->hasMany(UPB::class);
    }
}

