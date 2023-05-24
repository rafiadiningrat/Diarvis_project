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
use App\Models\KIBBModel;
use App\Models\KIBEModel;
use App\Models\PemilikModel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Bidang
Route::get('/bidang', [BidangModel::class, 'getBidang']);

// Unit
Route::get('/unit', [UnitModel::class, 'getAllUnit']);
Route::get('/unit/{id}', [UnitModel::class, 'getUnit']);

// Sub Unit
Route::get('/sub-unit', [SubUnitModel::class, 'getAllSubUnit']);
Route::get('/sub-unit/{id}', [SubUnitModel::class, 'getSubUnit']);

// UPB
Route::get('/upb', [UPBModel::class, 'getAllUpb']);
Route::get('/upb/{id}', [UPBModel::class, 'getUpb']);

// Grup
Route::get('/grup', [GrupModel::class, 'getGrup']);

// User
Route::get('/user', [UserModel::class, 'getAllUser']);
Route::get('/user/{id}', [UserModel::class, 'getUser']);

// KIB B
Route::get('/kib-b', [KIBBModel::class, 'getAllKibB']);
Route::get('/kib-b/{id}', [KIBBModel::class, 'getKibB']);

// Pemilik
Route::get('/pemilik', [PemilikModel::class, 'getPemilik']);


// Route::middleware('auth:api')->group(function () {
//     Route::resource('posts', AuthController::class);
// });
