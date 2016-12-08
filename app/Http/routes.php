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
	Route::post('content/merchantlistdata', 'Content\MerchantCenterController@postMerchantListData');
	Route::get('common/getrelatedurlbymerid', 'Common\MerchantLibController@getRelatedUrlByMerID');

	Route::group(['middleware' => 'share'], function () {
		include("path_routes.php");
	});
});