<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     * 列表
     */
    public function index(Request $request)
    {
        // 搜索
        $name = $request->get('name');
        $data = Role::when($name, function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%");
        })->paginate($this->pagesize);
        return view('admin.role.index', compact('data', 'name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name'
            ]);
            Role::create($request->only('name'));
        } catch (\Exception $exception) {
            return [
                'status' => 1000,
                'message' => '验证不通过'
            ];
        }
        return ['status' => 0, 'message' => 'success'];
    }

    /**
     * Display the specified resource.
     * 显示详情
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $model = Role::find($id);
        return view('admin.role.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * 修改操作
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, int $id)
    {
        try {
            // 唯一验证，但是要排除掉当前id这条记录
            $this->validate($request, [
                'name' => 'required|unique:roles,name,' . $id . ',id'
            ]);
            Role::find($id)->update($request->only(['name']));
            return ['status' => 0, 'message' => 'success'];
        } catch (\Exception $exception) {
            return [
                'status' => 1000,
                'message' => '验证不通过'
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
