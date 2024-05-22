<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_identifies_id' => 'sometimes|required',
            'name'     => 'sometimes|required',
            'no_hp'    => 'sometimes|required',
            'no_induk' => 'sometimes|required',
            'email'    => 'sometimes|required|unique:users',
            'password' => 'sometimes|required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user = User::create([
            'users_identifies_id' => $request->users_identifies_id,
            'name'      => $request->name,
            'no_hp'     => $request->no_hp,
            'no_induk'  => $request->no_induk,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        //assign roles to user
        $user->assignRole($request->roles);

        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {

            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 400);
        }

        return response()->json([
            'success'       => true,
            'user'          => auth()->guard('api')->user()->only(['name', 'email']),
            'permissions'   => auth()->guard('api')->user()->getPermissionArray(),
            'token'         => $token
        ], 201);

    }
}
