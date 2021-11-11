<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        $user = auth()->user();
        if (!$user->active)
            return $this->failJsonResponse([__('auth.blocked')]);
        $user->save();
        return $this->successJsonResponse([],new UserResource($user,$this->bearerToken()),'User');
    }
}
