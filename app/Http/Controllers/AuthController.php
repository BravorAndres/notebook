<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validas datos
        $credentials = $request->only('email','password');

        //validar y generar JWT

        if(!$token = Auth::attempt($credentials)){
            return response()->json(['error'=>'Unauthorized'],401);

        } else {
            return $this->respondWithToken($token);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'acces_token'=>$token,
            'token_type'=> 'bearer',
            
        ]);
    }
}
