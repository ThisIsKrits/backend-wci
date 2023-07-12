<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        // validation rules
        $validator = Validator::make($request->all(), [
            "email"         => "required",
            "password"      => "required|min:8"
        ]);

        // check validator fails
        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        // request credential
        $credential = $request->only("email", "password");

        // check auth attempt
        if(Auth::attempt($credential))
        {
            $user = Auth::user();

            // create token
            $token = $user->createToken("userToken")->plainTextToken;

            // reponse
            return response()->json([
                "success"       => true,
                "message"       => "Login success",
                "data"          => $user,
                "auth"          => [
                    "token"     => $token,
                    "type"      => "Bearer Token",
                ],
            ], 200);
        } else {
            // response
            return response()->json([
                "success"   => false,
                "error"     => "unauthorized"
            ], 401);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        return response()->json([
            "success"   => true,
            "message"   => "Logout success"
        ], 200);
    }
}
