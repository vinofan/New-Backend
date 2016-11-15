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
Route::controller('admin', 'Admin\AuthController');

// 发送密码重置链接路由
Route::get('password/email', 'Admin\PasswordController@getEmail');
Route::post('password/email', 'Admin\PasswordController@postEmail');

// 密码重置路由
Route::get('password/reset/{token}', 'Admin\PasswordController@getReset');
Route::post('password/reset', 'Admin\PasswordController@postReset');

Route::group(['middleware' => 'auth'], function () {
    //后台首页
    Route::get('home', 'Common\IndexController@index');

    //其他后台页面
    Route::get('testlogin', function () {
        return "test suc";
    });
});
