<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\StoreUserRequest;

class RegistrationController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->only('name', 'email') + ['password' => Hash::make($request->password)]);

        $permission = Permission::create([
            'user_id' => $user->id,
            'role' => 'client'
        ]);

        return response()->json(['message' => 'success'], 201);
    }
}
