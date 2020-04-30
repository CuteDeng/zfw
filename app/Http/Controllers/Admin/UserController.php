<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    //管理员列表
    public function index()
    {
        // 分页 withTrashed 查询所有用户，包括软删除的用户
        $data = User::orderBy('id', 'asc')->withTrashed()->paginate($this->pagesize);
        return view('admin.user.index', compact('data'));
    }

    // 添加管理员页面
    public function create()
    {
        return view('admin.user.create');
    }

    // 添加管理员操作
    public function store(Request $request)
    {
        // 表单验证
//        $this->validate($request, [
//            'truename' => 'required',
//            'username' => 'required',
//            'password' => 'required|confirmed',
//            'phone' => 'nullable|phone'
//        ], [
//            'truename.required' => '真实姓名不能为空',
        // 自定义验证规则
//            'phone.phone' => '手机号码不合法'
//        ]);
        $this->validate($request, [
            'truename' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'phone' => 'nullable|phone'
        ]);
        // 添加用户
        $post = $request->except(['_token', 'password_confirmation']);
        $model = User::create($post);

        return redirect(route('admin.user.index'))->with('success', '添加用户成功');
    }

    // 删除管理员
    public function del(int $id)
    {
        User::find($id)->delete();
        // 如果配置了软删除，可以用这种方式实现强制删除
//        User::find($id)->forceDelete();
        return ['status' => 0, 'message' => 'success'];
    }
    // 批量删除管理员
    public function delall(Request $request)
    {
        $ids = $request->get('id');
        User::destroy($ids);
        return ['status' => 0, 'message' => 'success'];
    }

    public function restore(int $id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect(route('admin.user.index'))->with('success', '还原用户成功');
    }

}
