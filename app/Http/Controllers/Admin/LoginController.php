<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // 显示登录
    public function index()
    {
        return view('admin.login.login');
    }

    public function login(Request $request){
        // 表单验证
       $post = $this->validate($request,[
            'username' =>'required',
            'password'=>'required'
        ]);
        dump($post);
    }
}
