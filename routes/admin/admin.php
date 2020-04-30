<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 登录先生
    Route::get('login', 'LoginController@index')->name('admin.login');
    // 登录处理
    Route::post('login', 'LoginController@login')->name('admin.login');
    // 欢迎页面,路由中间件
//    Route::get('welcome', 'IndexController@welcome')->name('admin.welcome')->middleware(['ckadmin']);
    // 分组中间件
    Route::group(['middleware' => ['ckadmin']], function () {
        // 后台首页
        Route::get('index', 'IndexController@index')->name('admin.index');
        Route::get('welcome', 'IndexController@welcome')->name('admin.welcome');
        // 退出登录
        Route::get('logout', 'IndexController@logout')->name('admin.logout');
        // 管理员列表
        Route::get('user/index', 'UserController@index')->name('admin.user.index');
        // 添加管理员
        Route::get('user/add', 'UserController@create')->name('admin.user.add');
        Route::post('user/add', 'UserController@store')->name('admin.user.add');
        // 删除管理员用户
        Route::delete('user/del/{id}', 'UserController@del')->name('admin.user.del');
    });
});
