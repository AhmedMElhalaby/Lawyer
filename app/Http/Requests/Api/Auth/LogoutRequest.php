<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Http\JsonResponse;

class LogoutRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        $this->user()->update(['device_token'=>null,'device_type'=>null]);
        $this->user()->token()->revoke();
        $this->user()->token()->delete();
        return $this->successJsonResponse([__('auth.logout')]);
    }
}
