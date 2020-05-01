<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Mail;
use Hash;

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
        $pwd = $post['password'];
        $model = User::create($post);
        // 发送邮件给用户，匿名函数使用use方式引入外部变量
        Mail::send('mail.adduser', compact('model', 'pwd'), function (Message $message) use ($model) {
            $message->to($model->email);
            $message->subject('添加用户成功');
        });
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

    // 还原用户
    public function restore(int $id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect(route('admin.user.index'))->with('success', '还原用户成功');
    }

    // 修改用户界面
    public function edit(int $id)
    {
        $model = User::find($id);
        return view('admin.user.edit', compact('model'));
    }

    // 修改用户操作
    public function update(Request $request, int $id)
    {
        $model = User::find($id);
        $oldPass = $model->password;
        $sPass = $request->get('spassword');
        // 验证原密码和旧密码是否一致
        $bool = Hash::check($sPass, $oldPass);
        if ($bool) {
            $data = $request->only([
                'truename',
                'password',
                'sex',
                'phone',
                'email'
            ]);
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            $model->update($data);
            return redirect(route('admin.user.index'))->with(['success' => '修改成功']);
        }
        return redirect(route('admin.user.edit', $model))->withErrors(['error' => '原密码错误']);
    }
}
