<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Country;
use App\Traits\AhmedPanelTrait;

class TagController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/tags');
        $this->setEntity(new Tag());
        $this->setTable('tags');
        $this->setLang('Tag');
        $this->setColumns([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'category_id'=> [
                'name'=>'category_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Category::all(),
                    'custom_search'=>function($Object){
                        return ($Object)?app()->getLocale() == 'ar'?$Object->name_ar:$Object->name:'-';
                    },
                    'custom'=>function($Object){
                        return ($Object)?app()->getLocale() == 'ar'?$Object->name_ar:$Object->name:'-';
                    },
                    'entity'=>'category'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'category_id'=> [
                'name'=>'category_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Category::all(),
                    'custom'=>function($Object){
                        return app()->getLocale() == 'ar'?$Object->name_ar:$Object->name;
                    },
                    'entity'=>'category'
                ],
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }
}
