<?php
namespace Database\Seeders;

use App\Helpers\Constant;
use App\Models\Employee;
use App\Models\Link;
use App\Models\ModelPermission;
use App\Models\ModelRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = (new Employee());
        $Admin->setName('Dashboard');
        $Admin->setEmail('admin@admin.com');
        $Admin->setPassword('123456');
        $Admin->save();
        $Role = new Role();
        $Role->setName('Super Dashboard');
        $Role->setNameAr('مدير عام');
        $Role->save();
        $Role->refresh();
        $PermissionsAndLinks = [
            'AppManagement'=>[
                'name'=>'App Management',
                'name_ar'=>'إدارة التطبيق',
                'key'=>'app_managements',
                'Children'=>[
                    'Employees'=>[
                        'name'=>'Employees',
                        'name_ar'=>'الموظفين',
                        'key'=>'employees',
                        'icon'=>'group'
                    ],
                    'Roles'=>[
                        'name'=>'Roles',
                        'name_ar'=>'الأدوار',
                        'key'=>'roles',
                        'icon'=>'accessibility'
                    ],
                ]
            ],
            'AppData'=>[
                'name'=>'App Data',
                'name_ar'=>'بيانات التطبيق',
                'key'=>'app_data',
                'Children'=>[
                    'Settings'=>[
                        'name'=>'Settings',
                        'name_ar'=>'الإعدادات',
                        'key'=>'settings',
                        'icon'=>'settings'
                    ],
                    'SplashScreens'=>[
                        'name'=>'Splash Screens',
                        'name_ar'=>'شاشات السبلاش',
                        'key'=>'splash_screens',
                        'icon'=>'fit_screen'
                    ],
                    'Categories'=>[
                        'name'=>'Categories',
                        'name_ar'=>'التصنيفات',
                        'key'=>'categories',
                        'icon'=>'category'
                    ],
                    'Tags'=>[
                        'name'=>'Tags',
                        'name_ar'=>'التاقات',
                        'key'=>'tags',
                        'icon'=>'card_membership'
                    ],
                    'Laws'=>[
                        'name'=>'Laws',
                        'name_ar'=>'القوانين',
                        'key'=>'laws',
                        'icon'=>'card_membership'
                    ],
                    'LawArticles'=>[
                        'name'=>'Law Articles',
                        'name_ar'=>'مواد القوانين',
                        'key'=>'laws_articles',
                        'icon'=>'card_membership'
                    ],
                    'LawArticlesTags'=>[
                        'name'=>'Law Articles Tags',
                        'name_ar'=>'الكلمات المفتاحية للقوانين ',
                        'key'=>'laws_articles_tags',
                        'icon'=>'card_membership'
                    ],
                ]
            ],
            'UsersManagements'=>[
                'name'=>'Users Managements',
                'name_ar'=>'إدارة المستخدمين',
                'key'=>'user_managements',
                'Children'=>[
                    'Users'=>[
                        'name'=>'Users',
                        'name_ar'=>'المستخدمين',
                        'key'=>'users',
                        'icon'=>'group'
                    ],
                    'Tickets'=>[
                        'name'=>'Tickets',
                        'name_ar'=>'التذاكر',
                        'key'=>'tickets',
                        'icon'=>'label'
                    ],
                ]
            ],
        ];
        $Settings = [
            'privacy'=>[
                'name'=>'Privacy Policy',
                'name_ar'=>'سياسة الخصوصية',
                'value'=>'Privacy Policy',
                'value_ar'=>'سياسة الخصوصية',
                'key'=>'privacy',
                'type'=>Constant::SETTING_TYPE['Page'],
            ],
            'about'=>[
                'name'=>'About Us',
                'name_ar'=>'من نحن',
                'value'=>'About Us',
                'value_ar'=>'من نحن',
                'key'=>'about',
                'type'=>Constant::SETTING_TYPE['Page'],
            ],
            'terms'=>[
                'name'=>'Terms And Conditions',
                'name_ar'=>'الشروط والأحكام',
                'value'=>'Terms And Conditions',
                'value_ar'=>'الشروط والأحكام',
                'key'=>'terms',
                'type'=>Constant::SETTING_TYPE['Page'],
            ],
            'cookies'=>[
                'name'=>'Cookies',
                'name_ar'=>'ملفات تعريف الارتباط',
                'value'=>'Cookies',
                'value_ar'=>'ملفات تعريف الارتباط',
                'key'=>'cookies',
                'type'=>Constant::SETTING_TYPE['Page'],
            ],
            'support'=>[
                'name'=>'Support',
                'name_ar'=>'الدعم',
                'value'=>'Support',
                'value_ar'=>'الدعم',
                'key'=>'support',
                'type'=>Constant::SETTING_TYPE['Page'],
            ],
            'twitter'=>[
                'name'=>'Twitter',
                'name_ar'=>'حساب تويتر',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'twitter',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'facebook'=>[
                'name'=>'Facebook',
                'name_ar'=>'حساب الفيسبوك',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'facebook',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'instagram'=>[
                'name'=>'Instagram',
                'name_ar'=>'حساب الانستقرام',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'instagram',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'linkedin'=>[
                'name'=>'LinkedIn',
                'name_ar'=>'حساب اللينكد ان',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'linkedin',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'email'=>[
                'name'=>'Email',
                'name_ar'=>'البريد الالكتروني',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'email',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'mobile'=>[
                'name'=>'Mobile',
                'name_ar'=>'رقم الجوال',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'mobile',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'app_store_link'=>[
                'name'=>'App Store Link',
                'name_ar'=>'رابط متجر ابل',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'app_store_link',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
            'play_store_link'=>[
                'name'=>'Google Play Store Link',
                'name_ar'=>' رابط متجر جوجل بلاي',
                'value'=>'',
                'value_ar'=>'',
                'key'=>'play_store_link',
                'type'=>Constant::SETTING_TYPE['Values'],
            ],
        ];
        foreach ($Settings as $setting){
            $Setting = new Setting();
            $Setting->setKey($setting['key']);
            $Setting->setName($setting['name']);
            $Setting->setNameAr($setting['name_ar']);
            $Setting->setValue($setting['value']);
            $Setting->setValueAr($setting['value_ar']);
            $Setting->setType($setting['type']);
            $Setting->save();
        }
        foreach ($PermissionsAndLinks as $object){
            $Permission = new Permission();
            $Permission->setName($object['name']);
            $Permission->setNameAr($object['name_ar']);
            $Permission->setKey($object['key']);
            $Permission->save();
            $Permission->refresh();
            $Link = new Link();
            $Link->setName($object['name']);
            $Link->setNameAr($object['name_ar']);
            $Link->setUrl($object['key']);
            $Link->setPermissionId($Permission->getId());
            $Link->save();
            $Link->refresh();
            foreach ($object['Children'] as $child){
                $CPermission = new Permission();
                $CPermission->setName($child['name']);
                $CPermission->setNameAr($child['name_ar']);
                $CPermission->setKey($child['key']);
                $CPermission->setParentId($Permission->getId());
                $CPermission->save();
                $CLink = new Link();
                $CLink->setName($child['name']);
                $CLink->setNameAr($child['name_ar']);
                $CLink->setUrl($child['key']);
                $CLink->setIcon($child['icon']);
                $CLink->setParentId($Link->getId());
                $CLink->setPermissionId($CPermission->getId());
                $CLink->save();
            }
        }
        foreach (Permission::all() as $permission){
            $RolePermission = new RolePermission();
            $RolePermission->setPermissionId($permission->getId());
            $RolePermission->setRoleId($Role->getId());
            $RolePermission->save();
        }
        foreach (Role::all() as $role){
            $ModelRole = new ModelRole();
            $ModelRole->setModelId($Admin->id);
            $ModelRole->setRoleId($role->getId());
            $ModelRole->save();
        }
        foreach (Permission::all() as $permission){
            $ModelPermission = new ModelPermission();
            $ModelPermission->setModelId($Admin->id);
            $ModelPermission->setPermissionId($permission->getId());
            $ModelPermission->save();
        }
        Artisan::call('passport:install');
    }
}
