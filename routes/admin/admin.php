<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    // 登录先生
    Route::get('login', 'LoginController@index')->name('login');
    // 登录处理
    Route::post('login', 'LoginController@login')->name('login');
    // 欢迎页面,路由中间件
//    Route::get('welcome', 'IndexController@welcome')->name('welcome')->middleware(['ckadmin']);
    // 分组中间件
    Route::group(['middleware' => ['ckadmin']], function () {
        // 后台首页
        Route::get('index', 'IndexController@index')->name('index');
        Route::get('welcome', 'IndexController@welcome')->name('welcome');
        // 退出登录
        Route::get('logout', 'IndexController@logout')->name('logout');
        // 管理员列表
        Route::get('user/index', 'UserController@index')->name('user.index');
        // 添加管理员
        Route::get('user/add', 'UserController@create')->name('user.add');
        Route::post('user/add', 'UserController@store')->name('user.add');
        // 删除管理员用户
        Route::delete('user/del/{id}', 'UserController@del')->name('user.del');
        // 批量删除管理员
        Route::delete('user/delall', 'UserController@delall')->name('user.delall');
        // 还原管理员
        Route::get('user/restore/{id}', 'UserController@restore')->name('user.restore');
        // 给管理员分配角色
        Route::match(['get', 'post'], 'user/role/{user}', 'UserController@role')->name('user.role');
        // 修改管理员
        Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::put('user/edit/{id}', 'UserController@update')->name('user.edit');
        // 权限管理，定义资源路由,as 用来设置别名前缀
        Route::resource('role', 'RoleController');
        Route::get('role/node/{role}', 'RoleController@node')->name('role.node');
        Route::post('role/node/{role}', 'RoleController@nodeSave')->name('role.node');
        Route::resource('node', 'NodeController');

        // 文章管理
        // 文件上传
        Route::post('article/upfile', 'ArticleController@upfile')->name('article.upfile');
        Route::resource('article', 'ArticleController');


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
