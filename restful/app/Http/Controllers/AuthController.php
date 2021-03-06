<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }
    // login function
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if($token =  auth('api')->attempt($credentials)){
            return $this->respondWithToken($token);
        }

        return response()->json([
            'status' => false,
            'error' => 'Invalid email or password.'
        ]);
    }
    //register function 
    public function register(Request $request)
    {
        $record = new User;
        $record->name = $request->name;
        $record->email = $request->email;
        $record->password = Hash::make($request->password);

        $record->save();

        return response()->json(['status'=>true, 'message'=>'User Created']);
    }

    //this function is used for logging in
    protected function guard(){
        return \Auth::guard('api');

    }

    // token when we login
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL()*60,
        ]);
    }
}
