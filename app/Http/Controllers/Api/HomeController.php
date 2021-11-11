<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\FaqRequest;
use App\Http\Requests\Api\Home\InstallRequest;
use App\Http\Requests\Api\Home\GetCategoryRequest;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function install(InstallRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function faqs(FaqRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function get_category(GetCategoryRequest $request): JsonResponse
    {
        return $request->run();
    }
}
