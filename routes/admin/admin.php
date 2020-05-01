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
        // 批量删除管理员
        Route::delete('user/delall', 'UserController@delall')->name('admin.user.delall');
        // 还原管理员
        Route::get('user/restore/{id}', 'UserController@restore')->name('admin.user.restore');
        // 修改管理员
        Route::get('user/edit/{id}','UserController@edit')->name('admin.user.edit');
        Route::put('user/edit/{id}','UserController@update')->name('admin.user.edit');
    });
});
Route::get('email', function () {
    // 发送普通文本
//    \Mail::raw('test send mail',function (\Illuminate\Mail\Message $message){
//        $message->to('1316896128@qq.com');
//        $message->subject('test');
//    });
    // 发送富文本
    \Mail::send('mail.adduser', ['user' => 'dave'], function (\Illuminate\Mail\Message $message) {
        $message->to('1316896128@qq.com');
        $message->subject('test');
    });
    dd(1);
});
