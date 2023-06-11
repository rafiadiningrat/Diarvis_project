<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BidangModel;

class BidangController extends Controller
{
    public function getBidang()
    {
        $bidang = BidangModel::all();
        return $bidang;
    }
}
