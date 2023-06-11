<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidangModel;
use Faker\Provider\ar_JO\Address;
use Illuminate\Http\Request;

class UnitModel extends Model
{
    use HasFactory;

    protected $table = 'unit';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function bidang()
    {
        return $this->belongsTo(BidangModel::class, 'kode_bidang', 'kode_bidang');
    }

    public function subUnit()
    {
        return $this->hasMany(SubUnitModel::class);
    }

    

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
