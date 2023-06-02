<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BidangModel extends Model
{
    use HasFactory;

    protected $table = 'bidang';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getBidang()
    {
        $bidang = BidangModel::all();
        return $bidang;
    }

    public function units()
    {
        return $this->hasMany(UnitModel::class);
    }
}
