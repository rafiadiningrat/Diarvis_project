<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikModel extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getPemilik()
    {
        $pemilik = PemilikModel::all();
        return $pemilik;
    }

    public function kibB()
    {
        return $this->hasMany(KIBBModel::class);
    }
}
