<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class  IndexController extends Controller
{
    // 后台首页
    public function index()
    {
        // 读取菜单
        $menuData = (new Node())->treeData();
        return view('admin.index.index',compact('menuData'));
    }

    // 欢迎页面
    public function welcome()
    {
        return view('admin.index.welcome');
    }

    // 用户退出
    public function logout()
    {
        auth()->logout();
        return redirect(route('admin.login'))->with('success', '请重新登录');
    }
}
