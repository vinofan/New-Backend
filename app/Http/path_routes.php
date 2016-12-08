<?php
    //后台首页
    Route::get('home', 'CommonController@index');

    //Manage
    Route::get('manage/addmodule', 'Manage\ManageController@getAddModule');
    Route::post('manage/addmodule', 'Manage\ManageController@postAddModule');

	Route::get('test', 'TestPaginateController@index');



Route::get('content/merchantcenter', 'Content\MerchantCenterController@getMerchantCenter');

Route::get('content/couponcenter', 'Content\CouponCenterController@getCouponCenter');
Route::post('content/batchactions', 'Content\CouponCenterController@postBatchActions');
Route::post('content/clickchange', 'Content\CouponCenterController@postClickChange');
