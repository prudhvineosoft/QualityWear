<?php

namespace App\Http\Controllers;

use App\Http\Resources\json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class customarAuth extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:4'
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'validation error', 'err' => 1]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->attachRole('user');
            return response(['message' => 'User create successfully', 'user' => $user, 'err' => 0]);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:4'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            if (!$token = auth()->guard('api')->attempt($validator->validated())) {
                return response()->json(['error' => 'Unauthorized', 'err' => 1], 200);
            }
            // $token = $this->respondWithToken($token);
            // return response()->json(['user' => $userData, 'token' => $token]);
            return response()->json(['error' => 0, 'token' => $token, 'email' => $request->email], 200);


            // return response(['user' => json::collection($userData), 'token' => json::collection($token), 'message' => 'fetch successfully'], 200);
        }
    }
    public function respondWithToken($token)
    {
        return response([
            'access_token' => $token,
            "token_type" => 'barer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }
    public function profile(Request $req)
    {
        $validator = true;
        $barer = $req->header('Authorization');
        $b = auth()->attempt(['true']);

        if ($barer == $b) {
            return response(['data' => auth()->user(), 'message' => 'fetch successfully', 'err' => 0], 200);
        } else {
            return response(['message' => "invalid barer", 'data1' => $barer, 'data2' => $b]);
        }
    }
    public function logout()
    {
        auth()->guard('api')->logout();
        return response()->json(["message" => "User Logout Successfully"]);
    }
}
