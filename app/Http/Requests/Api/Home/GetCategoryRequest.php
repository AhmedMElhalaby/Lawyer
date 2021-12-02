<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoriesResource;
use App\Http\Resources\Api\Home\LawArticleResource;
use App\Models\Category;
use App\Models\Law;
use App\Models\LawArticle;
use App\Models\LawArticleTag;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

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
        $articles = [];
        foreach ($arr as $a){
            $Tag = LawArticleTag::where('name',$a)->first();
            if ($Tag) {
                if (isset($articles[$Tag->getLawArticleId()])) {
                    $articles[$Tag->getLawArticleId()] +=1;
                }else{
                    $articles[$Tag->getLawArticleId()] =1;
                }
            }
        }
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

        $ArticleArray = [];
        if (count($articles) >0) {
            $FirstArticleId= array_keys($articles,max($articles));
            array_push($ArticleArray, $FirstArticleId[0]);
            unset($articles[$FirstArticleId[0]]);
            if (count($articles) >0) {
                $SecondArticleId= array_keys($articles,max($articles));
                array_push($ArticleArray, $SecondArticleId[0]);
                unset($articles[$SecondArticleId[0]]);
                if (count($articles) >0) {
                    $ThirdArticleId= array_keys($articles,max($articles));
                    array_push($ArticleArray, $ThirdArticleId[0]);
                    unset($articles[$ThirdArticleId[0]]);
                }
            }
        }
        if (count($cats)==0) {
            if(count($ArticleArray) == 0){
                return $this->failJsonResponse([__('messages.wrong_data')]);
            }else{
                $LwA = LawArticle::whereIn('id',$ArticleArray)->pluck('law_id');
                $CatId = Law::whereIn('id',$LwA)->pluck('category_id');
            }
        }else{
            $CatId= array_keys($cats,max($cats));
        }
        if (isset($CatId[0])) {
            $Category = (new Category())->find($CatId[0]);
            $LawArticles = (new LawArticle())->whereIn('id',$ArticleArray)->get();
            return $this->successJsonResponse([],[
                'Category'=>new CategoriesResource($Category),
                'LawArticles'=>LawArticleResource::collection($LawArticles)
            ]);
        }else{
            return $this->failJsonResponse([__('messages.wrong_data')]);
        }
    }
}
