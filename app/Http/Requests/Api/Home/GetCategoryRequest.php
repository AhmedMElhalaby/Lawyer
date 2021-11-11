<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoriesResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GetCategoryRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'text'=>'required|string',
        ];
    }
    public function run(): JsonResponse
    {
        $arr = explode(" ",$this->text);
        $Tag = Tag::whereIn('name',$arr)->select('category_id', DB::raw('count(*) as total'))->groupBy('category_id')->orderBy('total', 'DESC')->first();
        if ($Tag) {
            $Category = (new Category())->find($Tag->category_id);
            return $this->successJsonResponse([],new CategoriesResource($Category),'Category');
        }else{
            return $this->failJsonResponse([__('messages.wrong_data')]);
        }
    }
}
