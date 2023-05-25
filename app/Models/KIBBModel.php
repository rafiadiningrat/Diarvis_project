<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidangModel;
use App\Models\UnitModel;
use App\Models\SubUnitModel;
use App\Models\UPBModel;
use App\Models\PemilikModel;

class KIBBModel extends Model
{

    use HasFactory;

    protected $table = 'kib_b';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAllKibB()
    {
        $upb = KIBBModel::get();
        return $upb;
    }

    public function getKibB($kode_upb)
    {
        $kib = KIBBModel::with('bidang', 'unit', 'subUnit', 'upb')->where('kode_upb', $kode_upb)->get();
        $KibResponse = [];
        foreach ($kib as $value) {
            array_push($KibResponse, [
                'nama_bidang' => $value->bidang->nama_bidang,
                'nama_unit' => $value->unit->nama_unit,
                'nama_sub_unit' => $value->subUnit->nama_sub_unit,
                'nama_upb' => $value->upb->nama_upb,
                'id_aset_b' => $value->id_aset_b,
                'kode_pemilik' => $value->kode_pemilik,
                'merk' => $value->merk,
                'cc' => $value->cc,
                'bahan' => $value->bahan,
                'tgl_perolehan' => $value->tgl_perolehan,
                'nomor_pabrik' => $value->nomor_pabrik,
                'nomor_rangka' => $value->inomor_rangka,
                'nomor_mesin' => $value->nomor_mesin,
                'asal-usul' => $value->asal_usul,
                'kondisi' => $value->kondisi,
                'harga' => $value->harga,
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $KibResponse
            // 'data'=>$unit[0]
        ], 200);
    }


    public function unit()
    {
        return $this->belongsTo(UnitModel::class, 'kode_unit', 'kode_unit');
    }

    public function bidang()
    {
        return $this->belongsTo(BidangModel::class, 'kode_bidang', 'kode_bidang');
    }

    public function subUnit()
    {
        return $this->belongsTo(SubUnitModel::class, 'kode_sub_unit', 'kode_sub_unit');
    }

    public function upb()
    {
        return $this->belongsTo(UPBModel::class, 'kode_upb', 'kode_upb');
    }

    public function pemilik()
    {
        return $this->belongsTo(PemilikModel::class, 'kode_pemilik', 'kode_pemilik');
    }

}
