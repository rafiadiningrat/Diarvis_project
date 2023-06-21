<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\GrupModel;
use app\Models\User;
use app\Helpers\Functions;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;

class UserController extends Controller
{
    
    public function getAllUser()
    {


        $UserResponse = DB::table('USER')
        ->join('grup', 'USER.kode_grup', '=', 'grup.kode_grup')
        ->join('bidang', 'USER.kode_bidang', '=', 'bidang.kode_bidang')
        ->join('unit', function ($join) {
            $join->on('USER.kode_bidang', '=', 'unit.kode_bidang')
                ->on('USER.kode_unit', '=', 'unit.kode_unit');
        })
        ->join('sub_unit', function ($join) {
            $join->on('USER.kode_bidang', '=', 'sub_unit.kode_bidang')
                ->on('USER.kode_unit', '=', 'sub_unit.kode_unit')
                ->on('USER.kode_sub_unit', '=', 'sub_unit.kode_sub_unit');
        })
        ->join('upb', function ($join) {
            $join->on('USER.kode_bidang', '=', 'upb.kode_bidang')
                ->on('USER.kode_unit', '=', 'upb.kode_unit')
                ->on('USER.kode_sub_unit', '=', 'upb.kode_sub_unit')
                ->on('USER.kode_upb', '=', 'upb.kode_upb');
        })
        ->select(
            'grup.kode_grup',
            'grup.nama_grup',
            'upb.kode_upb',
            'upb.nama_upb',
            'sub_unit.kode_sub_unit',
            'sub_unit.nama_sub_unit',
            'unit.kode_unit',
            'unit.nama_unit',
            'bidang.kode_bidang',
            'bidang.nama_bidang',
            'USER.id_user',
            'USER.no_pegawai',
            'USER.nama_lengkap',
            'USER.email',
            'USER.password',
            'USER.no_hp'
        )
        ->get();

    return response()->json([
        'success' => true,
        'data' => $UserResponse
    ]);
        // $user = UserModel::with('grups', 'upb', 'bidang', 'unit', 'subUnit')->get();

        // $UserResponse = [];
        // foreach ($user as $user) {
        //     array_push($UserResponse, [
        //         'kode_grup' => $user->grups->kode_grup,
        //         'nama_grup' => $user->grups->nama_grup,
        //         'kode_upb' => $user->upb->kode_upb,
        //         'nama_upb'=> $user->upb->nama_upb,
        //         'kode_sub_unit'=> $user->subUnit->kode_sub_unit,
        //         'nama_sub_unit'=> $user->subUnit->nama_sub_unit,
        //         'kode_unit'=> $user->unit->kode_unit,
        //         'nama_unit'=> $user->unit->nama_unit,
        //         'kode_bidang'=> $user->bidang->kode_bidang,
        //         'nama_bidang'=> $user->bidang->nama_bidang,
        //         'id_user' => $user->id_user,
        //         'no_pegawai'=> $user->no_pegawai,
        //         'nama_lengkap'=> $user->nama_lengkap,
        //         'email'=> $user->email,
        //         'password'=> $user->password,
        //         'no_hp'=> $user->no_hp,
        //     ]);
        // }
        // // Verifikasi apakah Anda memiliki logika tambahan untuk memeriksa pengguna tanpa kata sandi
    
        // return response()->json([
        //     'success' => true,
        //     'data' => $UserResponse
        // ]);
    }

    public function getUser($kode_grup)
    {
        $user = UserModel::with('grups', 'upb', 'bidang', 'unit', 'subUnit')->where('kode_grup', $kode_grup)->get();

        $UserResponse = [];
        foreach ($user as $user) {
            array_push($UserResponse, [
                'kode_grup' => $user->grups->kode_grup,
                'nama_grup' => $user->grups->nama_grup,
                'kode_upb' => $user->upb->kode_upb,
                'nama_upb'=> $user->upb->nama_upb,
                'kode_sub_unit'=> $user->subUnit->kode_sub_unit,
                'nama_sub_unit'=> $user->subUnit->nama_sub_unit,
                'kode_unit'=> $user->unit->kode_unit,
                'nama_unit'=> $user->unit->nama_unit,
                'kode_bidang'=> $user->bidang->kode_bidang,
                'nama_bidang'=> $user->bidang->nama_bidang,
                'id_user' => $user->id_user,
                'no_pegawai'=> $user->no_pegawai,
                'nama_lengkap'=> $user->nama_lengkap,
                'email'=> $user->email,
                'password'=> $user->password,
                'no_hp'=> $user->no_hp,
            ]);
        }
        // Verifikasi apakah Anda memiliki logika tambahan untuk memeriksa pengguna tanpa kata sandi
    
        return response()->json([
            'success' => true,
            'data' => $UserResponse
        ]);
    }

    // $subUnitResponse = DB::table('USER')
    //     ->join('bidang', 'USER.kode_bidang', '=', 'bidang.kode_bidang')
    //     ->join('unit', function ($join) {
    //         $join->on('USER.kode_bidang', '=', 'unit.kode_bidang')
    //             ->on('USER.kode_unit', '=', 'unit.kode_unit');
    //     })
    //     ->join('sub_unit', function ($join) {
    //         $join->on('USER.kode_bidang', '=', 'sub_unit.kode_bidang')
    //             ->on('USER.kode_unit', '=', 'sub_unit.kode_unit')
    //             ->on('USER.kode_sub_unit', '=', 'sub_unit.kode_sub_unit');
    //     })
    //     ->join('upb', function ($join) {
    //         $join->on('USER.kode_bidang', '=', 'sub_unit.kode_bidang')
    //             ->on('USER.kode_unit', '=', 'sub_unit.kode_unit')
    //             ->on('USER.kode_sub_unit', '=', 'sub_unit.kode_sub_unit')
    //             ->on('USER.kode_upb', '=', 'upb.kode_upb');
    //     })
    //     ->select('bidang.kode_bidang', 'bidang.nama_bidang', 'unit.kode_unit', 'unit.nama_unit', 'sub_unit.kode_sub_unit', 'sub_unit.nama_sub_unit', 'upb.kode_upb', 'upb.nama_upb')
    //     ->get();

    public function detail($id_user)
    {
        $UserResponse = DB::table('USER')
        ->join('grup', 'USER.kode_grup', '=', 'grup.kode_grup')
        ->join('bidang', 'USER.kode_bidang', '=', 'bidang.kode_bidang')
        ->join('unit', function ($join) {
            $join->on('USER.kode_bidang', '=', 'unit.kode_bidang')
                ->on('USER.kode_unit', '=', 'unit.kode_unit');
        })
        ->join('sub_unit', function ($join) {
            $join->on('USER.kode_bidang', '=', 'sub_unit.kode_bidang')
                ->on('USER.kode_unit', '=', 'sub_unit.kode_unit')
                ->on('USER.kode_sub_unit', '=', 'sub_unit.kode_sub_unit');
        })
        ->join('upb', function ($join) {
            $join->on('USER.kode_bidang', '=', 'upb.kode_bidang')
                ->on('USER.kode_unit', '=', 'upb.kode_unit')
                ->on('USER.kode_sub_unit', '=', 'upb.kode_sub_unit')
                ->on('USER.kode_upb', '=', 'upb.kode_upb');
        })
        ->select(
            'grup.kode_grup',
            'grup.nama_grup',
            'upb.kode_upb',
            'upb.nama_upb',
            'sub_unit.kode_sub_unit',
            'sub_unit.nama_sub_unit',
            'unit.kode_unit',
            'unit.nama_unit',
            'bidang.kode_bidang',
            'bidang.nama_bidang',
            'USER.id_user',
            'USER.no_pegawai',
            'USER.nama_lengkap',
            'USER.email',
            'USER.password',
            'USER.no_hp'
        )
        ->where('id_user', $id_user)
        ->first();

    return response()->json([
        'success' => true,
        'data' => $UserResponse
    ]);
    }

    public function addUser(Request $request)
{

    $user = UserModel::create([
        'kode_grup' => $request->input('kode_grup'),
        'kode_upb' => $request->input('kode_upb'),
        'kode_sub_unit' => $request->input('kode_sub_unit'),
        'kode_unit' => $request->input('kode_unit'),
        'kode_bidang' => $request->input('kode_bidang'),
        'no_pegawai' => $request->input('no_pegawai'),
        'nama_lengkap' => $request->input('nama_lengkap'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'no_hp' => $request->input('no_hp'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'User Berhasil Ditambahkan',
        'data' => $user
    ], 201);
}

public function editUser(Request $request, $id_user)
{
    $user = UserModel::find($id_user);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $user->kode_grup = $request->input('kode_grup');
    $user->kode_upb = $request->input('kode_upb');
    $user->kode_sub_unit = $request->input('kode_sub_unit');
    $user->kode_unit = $request->input('kode_unit');
    $user->kode_bidang = $request->input('kode_bidang');
    $user->no_pegawai = $request->input('no_pegawai');
    $user->nama_lengkap = $request->input('nama_lengkap');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->no_hp = $request->input('no_hp');
    $user->updated_at = now();
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'User berhasil diperbarui',
        'data' => $user
    ], 200);
}

public function deleteUser($id_user)
{
    $user = UserModel::find($id_user);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $user->delete();

    return response()->json([
        'success' => true,
        'message' => 'User berhasil dihapus'
    ], 200);
}


    public function login(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'email'    => 'required',
        //     'password' => 'required'
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Validation Error',
        //         'errors'  => $validator->errors()
        //     ], 422);
        // }
    
        // $credentials = $request->only('email', 'password');

    
        // if (Auth::attempt($credentials)) {
        //     //$user = Auth::user();
        //     $user = UserModel::where('email', $request->email)->first();
        //     $response = [
        //         'success'      => true,
        //         'message'      => 'You are successfully logged in.',
        //         'user'         => [
        //             'id'   => $user->id,
        //             'role' => $user->role
        //         ]
        //     ];
        //     return response()->json($response, 200);
        // } 
        // else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorised',
        //         'error'   => 'Invalid credentials'
        //     ], 401);
        // }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $user = UserModel::with('grups', 'bidang', 'unit', 'subUnit', 'upb')
        ->where('email', $request->email)
        ->where('password', $request->email)
        ->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Diizinkan',
                'error' => 'Email tidak valid',
            ], 401);
        }
    
        // Verifikasi apakah Anda memiliki logika tambahan untuk memeriksa pengguna tanpa kata sandi
    
        return response()->json([
            'success' => true,
            'data' => [
                'id_user' => $user->id_user,
                'nama' => $user->nama_lengkap,
                'kode_group' => $user->grups->kode_grup,
                'grups' => $user->grups->nama_grup,
                'kode_bidang' => $user->bidang->kode_bidang,
                'nama_bidang' => $user->bidang->nama_bidang,
                'kode_unit' => $user->unit->kode_unit,
                'nama_unit' => $user->unit->nama_unit,
                'kode_sub_unit' => $user->subUnit->kode_sub_unit,
                'nama_sub_unit' => $user->subUnit->nama_sub_unit,
                'kode_upb' => $user->upb->kode_upb,
                'nama_upb' => $user->upb->nama_upb // Mengakses atribut "nama_grup" dari relasi "grup"
            ],
        ]);

    
    // $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');
    //     $credentials['password'] = bcrypt($credentials['password']);

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $response = [
    //             'id_user' => $user->id_user,
    //             'grup' => $user->grup,
    //         ];
    //         return response()->json(['success' => true, 'data' => $response]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
    Auth::logout();
    
    return response()->json([
        'success' => true,
        'message' => 'Logout berhasil',
    ]);
    }
    /**
     * User registration API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name'     => 'required',
    //         'email'    => 'required|email|unique:users',
    //         'password' => 'required|min:8'
    //     ]);

    //     if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);

    //     try {
    //         $user = User::create([
    //             'name'     => $request->name,
    //             'email'    => $request->email,
    //             'password' => bcrypt($request->password)
    //         ]);

    //         $success['name']  = $user->name;
    //         $message          = 'Yay! A user has been successfully created.';
    //         $success['token'] = $user->createToken('accessToken')->accessToken;
    //     } catch (Exception $e) {
    //         $success['token'] = [];
    //         $message          = 'Oops! Unable to create a new user.';
    //     }

    //     return sendResponse($success, $message);


}
