<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Law;
use App\Models\LawArticle;
use App\Traits\AhmedPanelTrait;

class LawArticleController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/laws_articles');
        $this->setEntity(new LawArticle());
        $this->setTable('laws_articles');
        $this->setLang('LawArticle');
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
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
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
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'text'=> [
                'name'=>'text',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'text_ar'=> [
                'name'=>'text_ar',
                'type'=>'textarea',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
//            'delete',
        ]);
    }
}
