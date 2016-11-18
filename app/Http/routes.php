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

Route::group(['middleware' => 'auth'], function () {
    //后台首页
    Route::get('home', 'CommonController@index');

    //其他后台页面
    Route::get('testlogin', function () {
        return "test suc";
    });

    //Manage
    Route::get('manage/addmodule', 'System\ManageController@getAddModule');
});
	