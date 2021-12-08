<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Functions;
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
        $cats = [];
        $ArticleArray = [];
        $words = Functions::GetWordsFromArray($arr);
        foreach ($arr as $a){
            $LawArticleTag = LawArticleTag::where('name',$a)->first();
            if ($LawArticleTag) {
                if (isset($articles[$LawArticleTag->getLawArticleId()])) {
                    $articles[$LawArticleTag->getLawArticleId()] +=1;
                }else{
                    $articles[$LawArticleTag->getLawArticleId()] =1;
                }
            }
            $Tag = Tag::where('name',$a)->first();
            if ($Tag) {
                if (isset($cats[$Tag->getCategoryId()])) {
                    $cats[$Tag->getCategoryId()] +=1;
                }else{
                    $cats[$Tag->getCategoryId()] =1;
                }
            }
        }
        foreach ($words as $w){
            $LawArticleTag = LawArticleTag::where('name',$w)->first();
            if ($LawArticleTag) {
                if (isset($articles[$LawArticleTag->getLawArticleId()])) {
                    $articles[$LawArticleTag->getLawArticleId()] +=1;
                }else{
                    $articles[$LawArticleTag->getLawArticleId()] =1;
                }
            }
            $Tag = Tag::where('name',$w)->first();
            if ($Tag) {
                if (isset($cats[$Tag->getCategoryId()])) {
                    $cats[$Tag->getCategoryId()] +=1;
                }else{
                    $cats[$Tag->getCategoryId()] =1;
                }
            }
        }
        if (count($articles) >0) {
            $FirstArticleId= array_keys($articles,max($articles));
            array_push($ArticleArray, [
                'article_id'=>$FirstArticleId[0],
                'count'=>$articles[$FirstArticleId[0]],
            ]);
            unset($articles[$FirstArticleId[0]]);
            if (count($articles) >0) {
                $SecondArticleId= array_keys($articles,max($articles));
                array_push($ArticleArray, [
                    'article_id'=>$SecondArticleId[0],
                    'count'=>$articles[$SecondArticleId[0]]
                ]);
                unset($articles[$SecondArticleId[0]]);
                if (count($articles) >0) {
                    $ThirdArticleId= array_keys($articles,max($articles));
                    array_push($ArticleArray, [
                        'article_id'=>$ThirdArticleId[0],
                        'count'=>$articles[$ThirdArticleId[0]]
                    ]);
                    unset($articles[$ThirdArticleId[0]]);
                }
            }
        }
        if (count($cats)==0) {
            if(count($ArticleArray) == 0){
                return $this->failJsonResponse([__('messages.wrong_data')]);
            }else{
                $LwA = LawArticle::whereIn('id',collect($ArticleArray)->pluck('article_id'))->pluck('law_id');
                $CatId = Law::whereIn('id',$LwA)->pluck('category_id');
            }
        }else{
            $CatId= array_keys($cats,max($cats));
        }
        if (isset($CatId[0])) {
            $Category = (new Category())->find($CatId[0]);
            $LawArticles = [];
            foreach ($ArticleArray as $art){
                array_push($LawArticles,new LawArticleResource((new LawArticle())->find($art['article_id']),$art['count']));
            }
            return $this->successJsonResponse([],[
                'Category'=>new CategoriesResource($Category),
                'LawArticles'=>$LawArticles
            ]);
        }else{
            return $this->failJsonResponse([__('messages.wrong_data')]);
        }
    }
}
