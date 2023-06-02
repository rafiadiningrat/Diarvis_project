<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupModel extends Model
{
    use HasFactory;

    protected $table = 'grup';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getGrup()
    {
        $grup = GrupModel::all();
        return $grup;
    }

    public function users()
    {
        return $this->hasMany(UserModel::class, 'id_user');
    }
}
