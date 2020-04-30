<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    //管理员列表
    public function index()
    {
        // 分页
        $data = User::paginate($this->pagesize);
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        dd(123);
    }
}
