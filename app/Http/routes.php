<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


// 后台登录
Route::get('admin/login', 'Admin\LoginController@index');

// 后台登录-提交
Route::post('admin/check_login', 'Admin\LoginController@checkLogin');


Route::group(['middleware' => 'auth'] , function ()
{	
	//后台首页
    Route::get('test', function () {
    return view('common');
});

    //其他后台页面

});