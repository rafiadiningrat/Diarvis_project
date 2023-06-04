<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\BidangModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use App\Models\GrupModel;
use App\Models\SubUnitModel;
use App\Models\UPBModel;
use App\Models\PengusulanPenghapusanAsetModel;
use App\Models\PengusulanPenghapusanAsetBModel;
use App\Models\KIBBModel;
use App\Models\KIBEModel;
use App\Models\PemilikModel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengusulanPenghapusanAsetBController;
use App\Http\Controllers\PenilaianPenghapusanAsetBController;
use App\Http\Controllers\VerifikasiPenghapusanAsetBController;
use App\Http\Controllers\PengusulanPenghapusanAsetEController;
use App\Http\Controllers\PenilaianPenghapusanAsetEController;
use App\Http\Controllers\VerifikasiPenghapusanAsetEController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KIBBController;
use App\Http\Controllers\KIBEController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    $res['message'] = config('app.name').' is online';

    if (app()->isLocal()) {
        $res['info'] = 'Laravel v'.app()->version(). ' (PHP v'.PHP_VERSION.')';
    }

    return response()->json($res);
});
// Login
Route::post('/login', [UserController::class, 'login']);  // login menggunakan email dan password
Route::post('/logout', [UserController::class, 'logout']); // logout biasa

// Bidang
Route::get('/bidang', [BidangModel::class, 'getBidang']); // get seluruh data bidang

// Unit
Route::get('/unit', [UnitModel::class, 'getAllUnit']); // get seluruh data unit saja
Route::get('/unit/{id}', [UnitModel::class, 'getUnit']); // get seluruh data unit berdasarkan bidang yang dipilih

// Sub Unit
Route::get('/sub-unit', [SubUnitModel::class, 'getAllSubUnit']); // get seluruh data sub unit saja
Route::get('/sub-unit/{id}', [SubUnitModel::class, 'getSubUnit']); // get seluruh data sub unit berdasarkan unit yang dipilih

// UPB
Route::get('/upb', [UPBModel::class, 'getAllUpb']); // get seluruh data upb saja
Route::get('/upb/{id}', [UPBModel::class, 'getUpb']); // get seluruh data upb berdasarkan sub unit yang dipilih

// Grup
Route::get('/grup', [GrupModel::class, 'getGrup']); // get seluruh data grup

// User
Route::get('/user', [UserController::class, 'getAllUser']); // get seluruh data user
Route::get('/user/{id}', [UserController::class, 'getUser']); // get seluruh data user berdasarkan grup yang dipilih 

// KIB B
Route::get('/kib-b', [KIBBController::class, 'getAllKibB']); // get seluruh data kib b
Route::get('/kib-b/{id}', [KIBBController::class, 'getKibB']); // get seluruh data kib b berdasarkan upb yang dipilih
Route::get('/kib-b/detail/{id}', [KIBBController::class, 'detail']);

// KIB E
Route::get('/kib-e', [KIBEController::class, 'getAllKibE']); // get seluruh data kib b
Route::get('/kib-e/{id}', [KIBEController::class, 'getKibE']); // get seluruh data kib b berdasarkan upb yang dipilih
Route::get('/kib-e/detail/{id}', [KIBEController::class, 'detail']);

// Usulan B
//Route::get('/', [PengusulanPenghapusanAsetBModel::class, 'getAllUsulanB']);
//Route::post('/', [PengusulanPenghapusanAsetBController::class, 'store']);
Route::get('/kibb/semua', [PengusulanPenghapusanAsetBController::class, 'index']); // get seluruh data pengusulan
Route::get('/kibb/usulanB/{id}', [PengusulanPenghapusanAsetBController::class, 'getListUsulanB']); // get seluruh data pengusulan berdasarkan user yang mengusulkan
Route::post('/kibb/usulan', [PengusulanPenghapusanAsetBController::class, 'store']); // membuat pengusulan penghapusan barang
Route::put('/kibb/usulan/update/{id}', [PengusulanPenghapusanAsetBController::class, 'update']); // melakukan update terhadap penghapusan barang
Route::delete('/kibb/usulan/{id}', [PengusulanPenghapusanAsetBController::class, 'destroy']); // melakukan penghapusan terhadap penghapusan barang
Route::get('/kibb/detail/{id}', [PengusulanPenghapusanAsetBController::class, 'detail']);

//Penilaian B
Route::get('/kibb/penilaian', [PenilaianPenghapusanAsetBController::class, 'index']);
Route::put('/kibb/usulanb/update-penilaian/{id}', [PenilaianPenghapusanAsetBController::class, 'updatePenilaianB']);
Route::post('/kibb/penilaian/diterima/{id}', [PenilaianPenghapusanAsetBController::class, 'approve']);
Route::post('/kibb/penilaian/ditolak/{id}', [PenilaianPenghapusanAsetBController::class, 'decline']);

// verifikator B
Route::get('/kibb/verifikasi', [VerifikasiPenghapusanAsetBController::class, 'index']);
Route::put('/kibb/verifikasi/diterima/{id}', [VerifikasiPenghapusanAsetBController::class, 'approve']); // proses verifikasi
Route::put('/kibb/verifikasi/ditolak/{id}', [VerifikasiPenghapusanAsetBController::class, 'decline']); // proses verifikasi

// Usulan E
//Route::get('/', [PengusulanPenghapusanAsetBModel::class, 'getAllUsulanB']);
//Route::post('/', [PengusulanPenghapusanAsetBController::class, 'store']);
Route::get('/kibe/semua', [PengusulanPenghapusanAsetEController::class, 'index']); // get seluruh data pengusulan
Route::get('/kibe/usulanE/{id}', [PengusulanPenghapusanAsetEController::class, 'getListUsulanE']); // get seluruh data pengusulan berdasarkan user yang mengusulkan
Route::post('/kibe/usulan', [PengusulanPenghapusanAsetEController::class, 'store']); // membuat pengusulan penghapusan barang
Route::put('/kibe/usulan/update/{id}', [PengusulanPenghapusanAsetEController::class, 'update']); // melakukan update terhadap penghapusan barang
Route::delete('/kibe/usulan/{id}', [PengusulanPenghapusanAsetEController::class, 'destroy']); // melakukan penghapusan terhadap penghapusan barang
Route::get('/kibe/detail/{id}', [PengusulanPenghapusanAsetEController::class, 'detail']);

//Penilaian E
Route::get('/kibe/penilaian', [PenilaianPenghapusanAsetEController::class, 'index']);
Route::put('/kibe/update-penilaian/{id}', [PenilaianPenghapusanAsetEController::class, 'updatePenilaianE']);
Route::post('/kibe/penilaian/diterima/{id}', [PenilaianPenghapusanAsetEController::class, 'approve']);
Route::post('/kibe/penilaian/ditolak/{id}', [PenilaianPenghapusanAsetEController::class, 'decline']);

// verifikator E
Route::get('/kibe/verifikasi', [VerifikasiPenghapusanAsetEController::class, 'index']);
Route::put('/kibe/verifikasi/diterima/{id}', [VerifikasiPenghapusanAsetEController::class, 'approve']); // proses verifikasi
Route::put('/kibe/verifikasi/ditolak/{id}', [VerifikasiPenghapusanAsetEController::class, 'decline']); // proses verifikasi

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboardBE']);
Route::get('/kibb/dashboard', [DashboardController::class, 'dashboardB']);
Route::get('/kibe/dashboard', [DashboardController::class, 'dashboardE']);

// Generate
Route::get('/kibb/export', [KIBBController::class, 'exportToExcel']);
Route::get('/kibe/export', [KIBEController::class, 'exportToExcel']);
Route::get('/kibb/custom-export', [KIBBController::class, 'exportData']);

// Pemilik
Route::get('/pemilik', [PemilikModel::class, 'getPemilik']);


// Route::middleware('auth:api')->group(function () {
//     Route::resource('posts', AuthController::class);
// });

// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
