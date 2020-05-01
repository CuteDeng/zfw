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
        return view('admin.role.index', compact('data','name'));
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
     * Show the form for editing the specified resource.
     * 修改页面
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 修改操作
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
