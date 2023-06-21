<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function getAllUnit()
    {
        $unit = Unit::all();
        return $unit;
    }

    public function getUnit($kode_bidang)
    {
        $unit = Unit::with('bidang')->where('kode_bidang', $kode_bidang)->get();
        $unitResponse = [];
        foreach ($unit as $value) {
            array_push($unitResponse, [
                'kode_unit' => $value->kode_unit,
                'nama_bidang' => $value->bidang->nama_bidang,
                'nama_unit' => $value->nama_unit,
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $unitResponse
            // 'data'=>$unit[0]
        ], 200);
    }
}
