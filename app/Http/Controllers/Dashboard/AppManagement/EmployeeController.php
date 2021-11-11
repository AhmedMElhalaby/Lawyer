<?php

namespace App\Http\Controllers\Dashboard\AppManagement;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Employee;
use App\Traits\AhmedPanelTrait;

class EmployeeController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_managements/employees');
        $this->setEntity(new Employee());
        $this->setTable('employees');
        $this->setLang('Employee');
        $this->setColumns([
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_searchable'=>false,
                'order'=>false
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'email'=> [
                'name'=>'email',
                'type'=>'email',
                'is_searchable'=>true,
                'order'=>true
            ],
            'active'=> [
                'name'=>'active',
                'type'=>'active',
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
            'email'=> [
                'name'=>'email',
                'type'=>'email',
                'is_required'=>true,
                'is_unique'=>true
            ],
            'password'=> [
                'name'=>'password',
                'type'=>'password',
                'confirmation'=>true,
                'editable'=>false,
                'is_required'=>true,
                'export'=>false
            ],
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_required'=>false,
                'is_required_update'=>false
            ],
            'active'=> [
                'name'=>'active',
                'type'=>'active',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'active',
            'change_password',
            'delete',
        ]);
    }

}
