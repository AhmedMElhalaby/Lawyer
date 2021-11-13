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
        $cats = [];
        foreach ($arr as $a){
            $Tag = Tag::where('name',$a)->first();
            if ($Tag) {
                if (isset($cats[$Tag->getCategoryId()])) {
                    $cats[$Tag->getCategoryId()] +=1;
                }else{
                    $cats[$Tag->getCategoryId()] =1;
                }
            }
        }
        $Id= array_keys($cats,max($cats));
        if (isset($Id[0])) {
            $Category = (new Category())->find($Id[0]);
            return $this->successJsonResponse([],new CategoriesResource($Category),'Category');
        }else{
            return $this->failJsonResponse([__('messages.wrong_data')]);
        }
    }
}
