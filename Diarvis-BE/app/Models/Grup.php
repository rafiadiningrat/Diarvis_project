<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $table = 'grup';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getGrup()
    {
        $grup = Grup::all();
        return $grup;
    }

    public function users()
    {
        return $this->hasMany(UserModel::class, 'id_user');
    }
}
