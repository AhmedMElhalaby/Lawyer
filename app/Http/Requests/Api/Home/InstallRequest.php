<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoriesResource;
use App\Http\Resources\Api\Home\SplashScreensResource;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SplashScreen;
use Illuminate\Http\JsonResponse;

class InstallRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        $SplashScreens = SplashScreensResource::collection(SplashScreen::where('active',true)->orderBy('order','desc')->get());
        $Categories = CategoriesResource::collection(Category::where('active', true)->get());
        $Settings = Setting::pluck((app()->getLocale() =='en')?'value':'value_ar','key')->toArray();
        return $this->successJsonResponse([],[
            'SplashScreens'=>$SplashScreens,
            'Categories' => $Categories,
            'Settings'=>$Settings,
            'Essentials'=>[
                'UserTypes'=>Constant::USER_TYPE,
                'ForgetPasswordTypes'=>Constant::FORGET_TYPE,
                'VerificationTypes'=>Constant::VERIFICATION_TYPE,
                'NotificationTypes'=>Constant::NOTIFICATION_TYPE,
            ]
        ]);
    }
}
