<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Bidang;

class BidangController extends Controller
{
    public function getBidang()
    {
        $bidang = Bidang::all();
        return $bidang;
    }
}
