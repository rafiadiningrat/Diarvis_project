<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
