<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Law;
use App\Models\LawArticle;
use App\Models\LawArticleTag;
use App\Traits\AhmedPanelTrait;

class LawArticleTagController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/laws_articles_tags');
        $this->setEntity(new LawArticleTag());
        $this->setTable('laws_articles_tags');
        $this->setLang('LawArticleTag');
        $this->setColumns([
            'law_id'=> [
                'name'=>'law_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Law::all(),
                    'custom_search'=>function($Object){
                        return ($Object)?app()->getLocale() == 'ar'?$Object->name_ar:$Object->name:'-';
                    },
                    'custom'=>function($Object){
                        return ($Object)?app()->getLocale() == 'ar'?$Object->name_ar:$Object->name:'-';
                    },
                    'entity'=>'law'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'law_article_id'=> [
                'name'=>'law_article_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> LawArticle::all(),
                    'custom_search'=>function($Object){
                        return ($Object)?app()->getLocale() == 'ar'?$Object->name_ar:$Object->name:'-';
                    },
                    'custom'=>function($Object){
                        return ($Object)?app()->getLocale() == 'ar'?$Object->name_ar:$Object->name:'-';
                    },
                    'entity'=>'law_article'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'law_id'=> [
                'name'=>'law_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Law::all(),
                    'custom'=>function($Object){
                        return app()->getLocale() == 'ar'?$Object->name_ar:$Object->name;
                    },
                    'entity'=>'law'
                ],
                'is_required'=>true
            ],
            'law_article_id'=> [
                'name'=>'law_article_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> LawArticle::all(),
                    'custom'=>function($Object){
                        return app()->getLocale() == 'ar'?$Object->name_ar:$Object->name;
                    },
                    'entity'=>'law_article'
                ],
                'is_required'=>true
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }
}
