<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class AuthController extends Controller
{
    public function auth(Request $request){
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();

        return response()->json([
            'acess_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(Request $request){
        $user = User::create($request->all());
        $user->generatePassword($request->password);
    }
}
