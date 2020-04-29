<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 登录先生
    Route::get('login', 'LoginController@index')->name('admin.login');
    // 登录处理
    Route::post('login','LoginController@login')->name('admin.login');
});
