<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use App\Models\VerifyAccounts;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class VerifyRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'mobile'=>'required_if:type,'.Constant::VERIFICATION_TYPE['Mobile'].'|exists:users,mobile',
            'email'=>'required_if:type,'.Constant::VERIFICATION_TYPE['Email'].'|exists:users,email',
            'code' => 'required|string',
            'type' => 'required|in:'.Constant::VERIFICATION_TYPE_RULES,
        ];
    }
    public function run(): JsonResponse
    {
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']) {
            $logged = User::where('mobile',$this->mobile)->first();
        }
        if ($this->type == Constant::VERIFICATION_TYPE['Email']) {
            $logged = User::where('email',$this->email)->first();
        }
        $verify = VerifyAccounts::where('user_id',$logged->getId())->where('type',$this->type)->first();
        if($this->code != $verify->getCode())
            return $this->failJsonResponse([__('auth.failed')]);
        if ($this->type == Constant::VERIFICATION_TYPE['Email']) {
            if($logged->getEmailVerifiedAt() != null)
                return $this->failJsonResponse([__('auth.verified_before')]);
            $logged->setEmailVerifiedAt(now());
            $logged->setEmailVerified(true);
        }
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']) {
            if($logged->getMobileVerifiedAt() != null)
                return $this->failJsonResponse([__('auth.verified_before')]);
            $logged->setMobileVerifiedAt(now());
            $logged->setMobileVerified(true);
        }
        $logged->save();
        DB::table('oauth_access_tokens')->where('user_id', $logged->id)->delete();
        $tokenResult = $logged->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return $this->successJsonResponse( [__('auth.login')], new UserResource($logged,$tokenResult->accessToken),'User');
    }
}
