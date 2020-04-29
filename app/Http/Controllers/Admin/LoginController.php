<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
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
//           $model = auth()->user();
//           $userinfo = $model->toArray();
            return redirect(route('admin.index'));
        }
        return redirect(route('admin.login'))->withErrors('登录失败');
    }
}
