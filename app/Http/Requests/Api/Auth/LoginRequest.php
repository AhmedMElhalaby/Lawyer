<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required|string',
            'device_token' => 'string|required_with:device_type',
            'device_type' => 'string|required_with:device_token',
        ];
    }
    public function run(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return $this->failJsonResponse([__('auth.failed')]);
        $user = $this->user();
        if (!$user->active)
            return $this->failJsonResponse([__('auth.blocked')]);
        DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->filled('device_token')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
            $user->save();
        }
        return $this->successJsonResponse( [__('auth.login')], new UserResource($user,$tokenResult->accessToken),'User');
    }
}
