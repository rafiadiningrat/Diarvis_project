<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GrupModel;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'USER';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function grups()
    {
        return $this->belongsTo(GrupModel::class, 'kode_grup', 'kode_grup');
    }

    public function upb()
    {
        return $this->belongsTo(UPBModel::class, 'kode_upb', 'kode_upb');
    }

    public function pengusulanB()
    {
        return $this->hasMany(PengusulanPenghapusanAsetBModel::class, 'id_usulan_b');
    }

    public function pengusulanE()
    {
        return $this->hasMany(PengusulanPenghapusanAsetEModel::class, 'id_usulan_e');
    }
}
