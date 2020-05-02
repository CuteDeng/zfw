<?php

namespace App\Models\Traits;


trait Btn
{
    /**
     * 根据用户权限，是否展示编辑按钮
     * @param string $route
     * @return string
     */
    public function editBtn(string $route)
    {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        } else {
            return '<a href="' . route($route, $this) . '" class="label label-success radius">修改</a>';
        }
    }

    /**
     * 根据用户权限，是否展示删除按钮
     * @param string $route
     * @return string
     */
    public function delBtn(string $route)
    {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        } else {
            return '<a href="' . route($route, $this) . '" class="label label-danger radius delbtn">删除</a>';
        }
    }
}
