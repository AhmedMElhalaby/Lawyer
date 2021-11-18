<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Dashboard" middleware group. Enjoy building your Dashboard!
|
*/
Route::get('app/lang', 'HomeController@lang');


/*
|--------------------------------------------------------------------------
| Dashboard Auth
|--------------------------------------------------------------------------
| Here is where admin auth routes exists for login and log out
*/
Route::group([
    'namespace'  => 'Auth',
], function() {
    Route::get('login', ['uses' => 'LoginController@showLoginForm','as'=>'dashboard.login']);
    Route::post('login', ['uses' => 'LoginController@login']);
    Route::group([
        'middleware' => 'auth.dashboard',
    ], function() {
        Route::post('logout', ['uses' => 'LoginController@logout','as'=>'dashboard.logout']);
    });
});
/*
|--------------------------------------------------------------------------
| Dashboard After login in
|--------------------------------------------------------------------------
| Here is where admin panel routes exists after login in
*/
Route::group([
    'middleware'  => 'auth.dashboard',
], function() {
    Route::get('/', 'HomeController@index');
    Route::get('delete/media', 'HomeController@delete_media');
    Route::post('notification/send', 'HomeController@general_notification');

    /*
    |--------------------------------------------------------------------------
    | Dashboard > App Management
    |--------------------------------------------------------------------------
    | Here is where App Management routes
    */

    Route::group([
        'prefix'=>'app_managements',
        'namespace'=>'AppManagement',
    ],function () {
        Route::group([
            'prefix'=>'employees'
        ],function () {
            Route::get('/','EmployeeController@index');
            Route::get('/create','EmployeeController@create');
            Route::post('/','EmployeeController@store');
            Route::get('/{employee}','EmployeeController@show');
            Route::get('/{employee}/edit','EmployeeController@edit');
            Route::put('/{employee}','EmployeeController@update');
            Route::delete('/{employee}','EmployeeController@destroy');
            Route::patch('/update/password',  'EmployeeController@updatePassword');
            Route::get('/option/export','EmployeeController@export');
            Route::get('/{id}/activation','EmployeeController@activation');
        });
        Route::group([
            'prefix'=>'roles'
        ],function () {
            Route::get('/','RoleController@index');
            Route::get('/create','RoleController@create');
            Route::post('/','RoleController@store');
            Route::get('/{role}','RoleController@show');
            Route::get('/{role}/edit','RoleController@edit');
            Route::put('/{role}','RoleController@update');
            Route::delete('/{role}','RoleController@destroy');
            Route::get('/option/export','RoleController@export');
        });
        Route::group([
            'prefix'=>'permissions'
        ],function () {
            Route::get('/','PermissionController@index');
            Route::get('/create','PermissionController@create');
            Route::post('/','PermissionController@store');
            Route::get('/{permission}','PermissionController@show');
            Route::get('/{permission}/edit','PermissionController@edit');
            Route::put('/{permission}','PermissionController@update');
            Route::delete('/{permission}','PermissionController@destroy');
            Route::get('/option/export','PermissionController@export');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Dashboard > App Data
    |--------------------------------------------------------------------------
    | Here is where App Data routes
    */
    Route::group([
        'prefix'=>'app_data',
        'namespace'=>'AppData',
    ],function () {
        Route::group([
            'prefix'=>'settings'
        ],function () {
            Route::get('/','SettingController@index');
            Route::get('/{setting}/edit','SettingController@edit');
            Route::put('/{setting}','SettingController@update');
        });
        Route::group([
            'prefix'=>'splash_screens'
        ],function () {
            Route::get('/','SplashScreenController@index');
            Route::get('/create','SplashScreenController@create');
            Route::post('/','SplashScreenController@store');
            Route::get('/{splash_screen}','SplashScreenController@show');
            Route::get('/{splash_screen}/edit','SplashScreenController@edit');
            Route::put('/{splash_screen}','SplashScreenController@update');
            Route::delete('/{splash_screen}','SplashScreenController@destroy');
            Route::get('/option/export','SplashScreenController@export');
        });
        Route::group([
            'prefix'=>'categories'
        ],function () {
            Route::get('/','CategoryController@index');
            Route::get('/create','CategoryController@create');
            Route::post('/','CategoryController@store');
            Route::get('/{category}','CategoryController@show');
            Route::get('/{category}/edit','CategoryController@edit');
            Route::put('/{category}','CategoryController@update');
            Route::delete('/{category}','CategoryController@destroy');
            Route::get('/option/export','CategoryController@export');
        });
        Route::group([
            'prefix'=>'tags'
        ],function () {
            Route::get('/','TagController@index');
            Route::get('/create','TagController@create');
            Route::post('/','TagController@store');
            Route::get('/{tag}','TagController@show');
            Route::get('/{tag}/edit','TagController@edit');
            Route::put('/{tag}','TagController@update');
            Route::delete('/{tag}','TagController@destroy');
            Route::get('/option/export','TagController@export');
        });
        Route::group([
            'prefix'=>'laws'
        ],function () {
            Route::get('/','LawController@index');
            Route::get('/create','LawController@create');
            Route::post('/','LawController@store');
            Route::get('/{law}','LawController@show');
            Route::get('/{law}/edit','LawController@edit');
            Route::put('/{law}','LawController@update');
            Route::delete('/{law}','LawController@destroy');
            Route::get('/option/export','LawController@export');
        });
        Route::group([
            'prefix'=>'laws_articles'
        ],function () {
            Route::get('/','LawArticleController@index');
            Route::get('/create','LawArticleController@create');
            Route::post('/','LawArticleController@store');
            Route::get('/{law_article}','LawArticleController@show');
            Route::get('/{law_article}/edit','LawArticleController@edit');
            Route::put('/{law_article}','LawArticleController@update');
            Route::delete('/{law_article}','LawArticleController@destroy');
            Route::get('/option/export','LawArticleController@export');
        });
        Route::group([
            'prefix'=>'laws_articles_tags'
        ],function () {
            Route::get('/','LawArticleTagController@index');
            Route::get('/create','LawArticleTagController@create');
            Route::post('/','LawArticleTagController@store');
            Route::get('/{law_article_tag}','LawArticleTagController@show');
            Route::get('/{law_article_tag}/edit','LawArticleTagController@edit');
            Route::put('/{law_article_tag}','LawArticleTagController@update');
            Route::delete('/{law_article_tag}','LawArticleTagController@destroy');
            Route::get('/option/export','LawArticleTagController@export');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Dashboard > App
    |--------------------------------------------------------------------------
    | Here is where App Content routes
    */
    Route::group([
        'prefix'=>'app_content',
        'namespace'=>'AppContent',
    ],function () {
    });
    /*
    |--------------------------------------------------------------------------
    | Dashboard > App Users
    |--------------------------------------------------------------------------
    | Here is where App Users routes
    */

    Route::group([
        'prefix'=>'user_managements',
        'namespace'=>'UserManagement',
    ],function () {
        Route::group([
            'prefix'=>'users'
        ],function () {
            Route::get('/','UserController@index');
            Route::get('/create','UserController@create');
            Route::post('/','UserController@store');
            Route::get('/{user}','UserController@show');
            Route::patch('/update/password',  'UserController@updatePassword');
            Route::get('/option/export','UserController@export');
            Route::get('/{user}/activation','UserController@activation');
            Route::delete('/{user}','UserController@destroy');
            Route::get('/{user}/active_mobile_email','UserController@active_mobile_email');
        });
        Route::group([
            'prefix'=>'tickets'
        ],function () {
            Route::get('/','TicketController@index');
            Route::get('/create','TicketController@create');
            Route::post('/','TicketController@store');
            Route::get('/{ticket}','TicketController@show');
            Route::post('/{ticket}/response','TicketController@response');
            Route::get('/{ticket}/close','TicketController@close');
        });
    });
});
