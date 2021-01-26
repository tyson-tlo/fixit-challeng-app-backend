<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();

        if (!$user) {
            return response("Not Authorized.", 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response("Not Authorized.", 401);
        }

        $token = $user->createToken("Auth Token")->accessToken;

        return response()->json(['token' => $token]);
    }
}
