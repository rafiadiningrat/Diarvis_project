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
use App\Http\Controllers\BidangController;
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
use App\Http\Controllers\SubUnitController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UpbController;

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
Route::get('/bidang', [BidangController::class, 'getBidang']); // get seluruh data bidang

// Unit
Route::get('/unit', [UnitController::class, 'getAllUnit']); // get seluruh data unit saja
Route::get('/unit/{id}', [UnitController::class, 'getUnit']); // get seluruh data unit berdasarkan bidang yang dipilih

// Sub Unit
Route::get('/sub-unit', [SubUnitController::class, 'getAllSubUnit']); // get seluruh data sub unit saja
Route::get('/sub-unit/{kode_bidang}/{kode_unit}', [SubUnitController::class, 'getSubUnit']); // get seluruh data sub unit berdasarkan unit yang dipilih

// UPB
Route::get('/upb', [UpbController::class, 'getAllUpb']); // get seluruh data upb saja
Route::get('/upb/{kode_bidang}/{kode_unit}/{kode_sub_unit}', [UpbController::class, 'getUpb']); // get seluruh data upb berdasarkan sub unit yang dipilih

// Grup
Route::get('/grup', [GrupModel::class, 'getGrup']); // get seluruh data grup

// User
Route::get('/user', [UserController::class, 'getAllUser']); // get seluruh data user
Route::get('/user/{id}', [UserController::class, 'getUser']); // get seluruh data user berdasarkan grup yang dipilih 
Route::post('/create/user', [UserController::class, 'addUser']);
Route::get('/detail/user/{id}', [UserController::class, 'detail']);
Route::put('/update/user/{id}', [UserController::class, 'editUser']);
Route::delete('/delete/user/{id}', [UserController::class, 'deleteUser']);

// KIB B
Route::get('/kib-b', [KIBBController::class, 'getAllKibB']); // get seluruh data kib b
Route::get('/kib-b/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBBController::class, 'getKibB']); // get seluruh data kib b berdasarkan upb yang dipilih
Route::get('/kib-b/detail/{id}', [KIBBController::class, 'getDetailKibB']);

// KIB E
Route::get('/kib-e', [KIBEController::class, 'getAllKibE']); // get seluruh data kib b
Route::get('/kib-e/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBEController::class, 'getKibE']); // get seluruh data kib b berdasarkan upb yang dipilih
Route::get('/kib-e/detail/{id}', [KIBEController::class, 'detail']);

// Usulan B
//Route::get('/', [PengusulanPenghapusanAsetBModel::class, 'getAllUsulanB']);
//Route::post('/', [PengusulanPenghapusanAsetBController::class, 'store']);
//Route::get('/kibb/usulanB/{id}', [PengusulanPenghapusanAsetBController::class, 'getListUsulanB']); // get seluruh data pengusulan berdasarkan user yang mengusulkan
Route::get('/kibb/semua', [PengusulanPenghapusanAsetBController::class, 'index']); // get seluruh data pengusulan
Route::post('/kibb/usulan', [PengusulanPenghapusanAsetBController::class, 'addUsulanB']); // membuat pengusulan penghapusan barang
Route::put('/kibb/usulan/update/{id}', [PengusulanPenghapusanAsetBController::class, 'update']); // melakukan update terhadap penghapusan barang
Route::delete('/kibb/usulan/{id}', [PengusulanPenghapusanAsetBController::class, 'destroy']); // melakukan penghapusan terhadap penghapusan barang
Route::get('/kibb/usulan/detail/{id}', [PengusulanPenghapusanAsetBController::class, 'getDetailUsulanB']);
Route::get('/kibb/belumUsulan/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [PengusulanPenghapusanAsetBController::class, 'getBarangBelumUsulan']);


//Penilaian B
Route::get('/kibb/all/penilaian/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [PenilaianPenghapusanAsetBController::class, 'index']);
Route::get('/kibb/penilaian/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [PenilaianPenghapusanAsetBController::class, 'getPenilaianbyUpbB']);
Route::put('/kibb/usulanb/update-penilaian/{id}', [PenilaianPenghapusanAsetBController::class, 'updatePenilaianB']);
Route::post('/kibb/penilaian/diterima/{id}', [PenilaianPenghapusanAsetBController::class, 'addApprovePenilaianB']);
Route::post('/kibb/penilaian/ditolak/{id}', [PenilaianPenghapusanAsetBController::class, 'addDeclinePenilaianB']);
Route::get('/kibb/penilaian/detail/{id}', [PenilaianPenghapusanAsetBController::class, 'getDetailPenilaianB']);

// verifikator B
Route::get('/kibb/all/verifikasi/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [VerifikasiPenghapusanAsetBController::class, 'index']);
Route::get('/kibb/verifikasi/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [VerifikasiPenghapusanAsetBController::class, 'getVerifikasiByUpb']);
Route::post('/kibb/verifikasi/diterima/{id}', [VerifikasiPenghapusanAsetBController::class, 'addApproveVerifikasiB']); // proses verifikasi
Route::post('/kibb/verifikasi/ditolak/{id}', [VerifikasiPenghapusanAsetBController::class, 'addDeclineVerifikasiB']); // proses verifikasi
Route::get('/kibb/verifikasi/detail/{id}', [VerifikasiPenghapusanAsetBController::class, 'getDetailVerifikasiB']);

// Usulan E
//Route::get('/', [PengusulanPenghapusanAsetBModel::class, 'getAllUsulanB']);
//Route::post('/', [PengusulanPenghapusanAsetBController::class, 'store']);
Route::get('/kibe/semua', [PengusulanPenghapusanAsetEController::class, 'index']); // get seluruh data pengusulan
Route::get('/kibe/usulanE/{id}', [PengusulanPenghapusanAsetEController::class, 'getListUsulanE']); // get seluruh data pengusulan berdasarkan user yang mengusulkan
Route::post('/kibe/usulan', [PengusulanPenghapusanAsetEController::class, 'addUsulanE']); // membuat pengusulan penghapusan barang
Route::put('/kibe/usulan/update/{id}', [PengusulanPenghapusanAsetEController::class, 'update']); // melakukan update terhadap penghapusan barang
Route::delete('/kibe/usulan/{id}', [PengusulanPenghapusanAsetEController::class, 'destroy']); // melakukan penghapusan terhadap penghapusan barang
Route::get('/kibe/detail/{id}', [PengusulanPenghapusanAsetEController::class, 'getDetailUsulanE']);
Route::get('/kibe/belumUsulan/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [PengusulanPenghapusanAsetEController::class, 'getBarangBelumUsulan']);

//Penilaian E
Route::get('/kibe/all/penilaian/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [PenilaianPenghapusanAsetEController::class, 'index']);
Route::put('/kibe/update-penilaian/{id}', [PenilaianPenghapusanAsetEController::class, 'updatePenilaianE']);
Route::post('/kibe/penilaian/diterima/{id}', [PenilaianPenghapusanAsetEController::class, 'approve']);
Route::post('/kibe/penilaian/ditolak/{id}', [PenilaianPenghapusanAsetEController::class, 'decline']);
Route::get('/kibe/penilaian/detail/{id}', [PenilaianPenghapusanAsetEController::class, 'detailPenilaian']);
Route::get('/kibe/penilaian/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [PenilaianPenghapusanAsetEController::class, 'getPenilaianByUpb']);

// verifikator E
Route::get('/kibe/all/verifikasi/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [VerifikasiPenghapusanAsetEController::class, 'index']);
Route::get('/kibe/verifikasi/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [VerifikasiPenghapusanAsetEController::class, 'getVerifikasiByUpb']);
Route::post('/kibe/verifikasi/diterima/{id}', [VerifikasiPenghapusanAsetEController::class, 'approve']); // proses verifikasi
Route::post('/kibe/verifikasi/ditolak/{id}', [VerifikasiPenghapusanAsetEController::class, 'decline']); // proses verifikasi
Route::get('/kibe/verifikasi/detail/{id}', [VerifikasiPenghapusanAsetBController::class, 'detailVerifikasi']);


// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboardBE']);
Route::get('/kibb/dashboard/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [DashboardController::class, 'dashboardB']);
Route::get('/kibe/dashboard/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [DashboardController::class, 'dashboardE']);

// Generate
Route::get('/kibb/excel/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBBController::class, 'getExportToExcel']);
Route::get('/kibe/excel/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBEController::class, 'exportToExcel']);
Route::get('/kibb/laporan-penghapusan/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBBController::class, 'getExportData']);
Route::get('/kibe/laporan-penghapusan/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBEController::class, 'exportData']);
Route::get('/berita-acara/{kode_bidang}/{kode_unit}/{kode_sub_unit}/{kode_upb}', [KIBBController::class, 'getExportDataToPDFe']);

// Pemilik
Route::get('/pemilik', [PemilikModel::class, 'getPemilik']);


// Route::middleware('auth:api')->group(function () {
//     Route::resource('posts', AuthController::class);
// });

// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
