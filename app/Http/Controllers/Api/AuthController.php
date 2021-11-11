<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\LogoutRequest;
use App\Http\Requests\Api\Auth\PasswordRequest;
use App\Http\Requests\Api\Auth\RefreshRequest;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Http\Requests\Api\Auth\ResendVerifyRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\ShowRequest;
use App\Http\Requests\Api\Auth\UpdateRequest;
use App\Http\Requests\Api\Auth\VerifyRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function show(ShowRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function refresh(RefreshRequest $request): JsonResponse
    {
         return $request->run();
    }

    public function change_password(PasswordRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function resend_verify(ResendVerifyRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function verify(VerifyRequest $request): JsonResponse
    {
         return $request->run();
    }

    public function forget_password(ForgetPasswordRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function reset_password(ResetPasswordRequest $request): JsonResponse
    {
        return $request->run();
    }
}
