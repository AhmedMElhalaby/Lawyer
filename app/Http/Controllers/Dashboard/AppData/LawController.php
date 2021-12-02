<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Category;
use App\Models\Law;
use App\Traits\AhmedPanelTrait;

class LawController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/laws');
        $this->setEntity(new Law());
        $this->setTable('laws');
        $this->setLang('Law');
        $this->setColumns([
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
            'name_ar'=> [
                'name'=>'name_ar',
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
//            'delete',
        ]);
    }
}
