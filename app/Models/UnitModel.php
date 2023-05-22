<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidangModel;
use Illuminate\Http\Request;

class UnitModel extends Model
{
    use HasFactory;

    protected $table = 'unit';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAllUnit()
    {
        $unit = UnitModel::all();
        return $unit;
    }

    public function bidang()
    {
        return $this->belongsTo(BidangModel::class, 'kode_bidang', 'kode_bidang');
    }

    public function subUnits()
    {
        return $this->hasMany(SubUnitModel::class);
    }

    public function getUnit($kode_bidang)
    {
        $unit = UnitModel::with('bidang')->where('kode_bidang', $kode_bidang)->get();
        return response()->json([
            'success' => true,
            'data' => $unit,
        ], 200);

        // $bidang = BidangModel::where('kode_bidang', $request->kode_bidang)->firstOrFail();
        // $model = UnitModel::where('kode_unit', $bidang->kode_unit)->select('nama_unit')->first();
        // return response()->json([
        //     'success' => true,
        //     'data' => $model,
        // ], 200);

        // $unit = UnitModel::with('bidang')->whereHas('bidang', function ($query) use ($nama_bidang) {
        //     $query->where('nama_bidang', $nama_bidang);
        // })->get();
    
        // return $unit;
    }
}
