<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Respond with Token
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validation->fails()) {
            return response()->json($validation->errors(), 202);
        }

        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);

        $user = User::create($allData);
        $resArr = [];
        $resArr['token'] = $user->createToken('api-application')->accessToken;
        $resArr['name'] = $user->name;

        return response()->json($resArr, 200);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if (auth('web')->attempt($credentials)) {
            $token = auth('web')->user()->createToken('api-application')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
