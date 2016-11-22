<?php
    //后台首页
    Route::get('home', 'CommonController@index');

    //Manage
    Route::get('manage/addmodule', 'Manage\ManageController@getAddModule');

Route::get('test', 'TestPaginateController@index');

Route::get('test/testaddpath', 'Test\TestAddPathController@getTestAddPath');