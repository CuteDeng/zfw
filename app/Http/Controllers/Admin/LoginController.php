<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['ckadmin']);
//    }

    // 显示登录
    public function index()
    {
        // 判断用户是否已经登录
        if (auth()->check()) {
            return redirect(route('admin.index'));
        }
        return view('admin.login.login');
    }

    public function login(Request $request)
    {
        // 表单验证
        $post = $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        // 登录
        $bool = auth()->attempt($post);
        if ($bool) {
            // 判断是不是超级管理员
            if (env('SUPER') == $post['username']) {
                session(['admin.auth' => true]);
            } else {
                // 获取当前用户的权限，存储到session中
                $userModel = auth()->user();
                $roleModel = $userModel->role;
                $nodes = $roleModel->nodes()->pluck('name', 'id')->toArray();
                session(['admin.auth' => $nodes]);
            }

            return redirect(route('admin.index'));
        }
        return redirect(route('admin.login'))->withErrors('登录失败');
    }
}
