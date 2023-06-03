<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\GrupModel;
use app\Models\User;
use app\Helpers\Functions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;

class UserController extends Controller
{
    
    public function getAllUser()
    {
        $user = UserModel::all();
        return $user;
    }

    public function getUser($kode_grup)
    {
        $user = UserModel::where('kode_grup', $kode_grup)->get();
        return $user;
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
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $user = UserModel::with('grups')->where('email', $request->email)->first();
    
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
                'grups' => $user->grups->nama_grup, // Mengakses atribut "nama_grup" dari relasi "grup"
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
