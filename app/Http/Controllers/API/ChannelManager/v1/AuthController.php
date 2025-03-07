<?php

namespace App\Http\Controllers\API\ChannelManager\v1;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\ApiResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 400);
        }

        $credentials = $request->only('email', 'password');

        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response(['errors' => ['Invalid Credentials']], 422);
        }

        $role = auth()->guard('api')->user()->getRoleNames()->first();

        if ($role != RoleType::PROPERTY_OWNER()) {
            return response(['errors' => ['Invalid Credentials']], 422);
        }

        $user = User::find(auth()->guard('api')->id());

        $user->access_token = $token;
        $user->expires_in = auth()->guard('api')->factory()->getTTL() * 60;

        return new ApiResource($user);
    }

    public function logout(Request $request)
    {
        auth()->guard('api')->logout();

        return response([
            'message' => 'Successfully logged out',
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(auth()->guard('api')->id());

        return new ApiResource($user);
    }

    public function refreshToken(Request $request)
    {
        $user = User::find(auth()->guard('api')->id());

        $user->access_token = auth()->guard('api')->refresh();
        $user->expires_in = auth()->guard('api')->factory()->getTTL() * 60;

        return new ApiResource($user);
    }
}
