<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GrupModel;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class UserModel extends Model
{
    use HasFactory, HasTimestamps;

    protected $table = 'USER';
    protected $primaryKey = 'id_user'; // Add the custom primary key column name
    protected $guarded = ['id_user'];
    public $timestamps = true;
    protected $casts = [
        'updated_at' => 'datetime',
    ];


    public function grups()
    {
        return $this->belongsTo(Grup::class, 'kode_grup', 'kode_grup');
    }

    public function upb()
    {
        return $this->belongsTo(UPB::class, 'kode_upb', 'kode_upb');
    }

    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class, 'kode_sub_unit', 'kode_sub_unit');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'kode_unit', 'kode_unit');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'kode_bidang', 'kode_bidang');
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
