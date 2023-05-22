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

    public function getAllUser()
    {
        $user = UserModel::all();
        return $user;
    }

    public function getUser($kode_grup)
    {
        $user = UserModel::where('kode_grup', $kode_grup)->get();
        return $user;
    }

    public function grups()
    {
        return $this->belongsTo(GrupModel::class, 'kode_grup', 'kode_grup');
    }
}
