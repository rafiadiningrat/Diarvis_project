<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubUnitModel;
use Illuminate\Support\Facades\DB;

class SubUnitController extends Controller
{
    public function getAllSubUnit()
    {
        $sub_unit = SubUnitModel::all();
        return $sub_unit;
    }

    public function getSubUnit($kode_bidang, $kode_unit)
    {

        $subUnitResponse = DB::table('sub_unit')
        ->join('bidang', 'sub_unit.kode_bidang', '=', 'bidang.kode_bidang')
        ->join('unit', function ($join) {
            $join->on('sub_unit.kode_bidang', '=', 'unit.kode_bidang')
                ->on('sub_unit.kode_unit', '=', 'unit.kode_unit');
        })
        ->select('bidang.kode_bidang', 'bidang.nama_bidang', 'unit.kode_unit', 'unit.nama_unit', 'sub_unit.kode_sub_unit', 'sub_unit.nama_sub_unit')
        ->where('sub_unit.kode_bidang', $kode_bidang)
        ->where('sub_unit.kode_unit', $kode_unit)
        ->get();

    return response()->json([
        'success' => true,
        'data' => $subUnitResponse
    ], 200);

    //     $subUnits = SubUnitModel::join('unit', 'sub_unit.kode_unit', '=', 'unit.kode_unit')
    //     ->join('bidang', 'unit.kode_bidang', '=', 'bidang.kode_bidang')
    //     ->where('bidang.kode_bidang', '=', $kode_bidang)
    //     ->where('unit.kode_unit', '=', $kode_unit)
    //     ->select('bidang.kode_bidang', 'bidang.nama_bidang', 'unit.kode_unit', 'unit.nama_unit', 'sub_unit.kode_sub_unit', 'sub_unit.nama_sub_unit')
    //     ->get();

    // $subUnitResponse = [];
    // foreach ($subUnits as $value) {
    //     array_push($subUnitResponse, [
    //         'kode_bidang' => $value->kode_bidang,
    //         'nama_bidang' => $value->nama_bidang,
    //         'kode_unit' => $value->kode_unit,
    //         'nama_unit' => $value->nama_unit,
    //         'kode_sub_unit' => $value->kode_sub_unit,
    //         'nama_sub_unit' => $value->nama_sub_unit,
    //     ]);
    // }

    // return response()->json([
    //     'success' => true,
    //     'data' => $subUnitResponse
    // ], 200);

    //     $upb = SubUnitModel::join('unit', 'sub_unit.kode_unit', '=', 'unit.kode_unit')
    //     ->join('bidang', 'unit.kode_bidang', '=', 'bidang.kode_bidang')
    //     ->where('bidang.kode_bidang', $kode_bidang)
    //     ->where('unit.kode_unit', $kode_unit)
    //     ->select('bidang.kode_bidang', 'bidang.nama_bidang', 'unit.kode_unit', 'unit.nama_unit', 'sub_unit.kode_sub_unit', 'sub_unit.nama_sub_unit')
    //     ->get();

    // $subUnitResponse = [];
    // foreach ($upb as $value) {
    //     array_push($subUnitResponse, [
    //         'kode_bidang' => $value->kode_bidang,
    //         'nama_bidang' => $value->nama_bidang,
    //         'kode_unit' => $value->kode_unit,
    //         'nama_unit' => $value->nama_unit,
    //         'kode_sub_unit' => $value->kode_sub_unit,
    //         'nama_sub_unit' => $value->nama_sub_unit,
    //     ]);
    // }

        // $unit = SubUnitModel::with('bidang', 'unit')
        // ->where('kode_bidang', $kode_bidang)
        // ->where('kode_unit', $kode_unit)->get();
        // $subUnitResponse = [];
        // foreach ($unit as $value) {
        //     array_push($subUnitResponse, [
        //         'kode_bidang' => $value->bidang->kode_bidang,
        //         'nama_bidang' => $value->bidang->nama_bidang,
        //         'kode_unit' => $value->unit->kode_unit,
        //         'nama_unit' => $value->unit->nama_unit,
        //         'kode_sub_unit' => $value->kode_sub_unit,
        //         'nama_sub_unit' => $value->nama_sub_unit,
        //     ]);
        // }
        // return response()->json([
        //     'success' => true,
        //     'data' => $subUnitResponse
        //     // 'data'=>$unit[0]
        // ], 200);
        
    }
}
