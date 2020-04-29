<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
// 继承auth登录的模型类
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    // 设置添加的字段(这里只针对create方式添加数据才有效，insert方式无效，但是insert方式不利于我们管理created_at和updated_at字段)
    // 拒绝不添加的字符
    protected $guarded = [];
}
