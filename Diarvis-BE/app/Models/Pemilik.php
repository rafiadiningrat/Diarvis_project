<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getPemilik()
    {
        $pemilik = Pemilik::all();
        return $pemilik;
    }

    public function kibB()
    {
        return $this->hasMany(KIBB::class);
    }
}
