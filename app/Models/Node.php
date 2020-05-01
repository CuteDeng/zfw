<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Base
{
    // 修改器
    public function setRouteNameAttribute($value)
    {
        $this->attributes['route_name'] = empty($value) ? '' : $value;
    }

    // 访问器
    public function getMenuAttribute()
    {
        if ($this->is_menu == '1') {
            return '<span class="label label-success radius">是</span>';
        } else {
            return '<span class="label label-danger radius">否</span>';
        }
    }

    // 获取所有节点
    public function getAllList()
    {
        $data = self::get()->toArray();
        return $this->treeLevel($data);
    }

    // 获取树状结构的节点
    public function treeData()
    {
        $data = Node::where('is_menu', '1')->get()->toArray();
        return $this->subTree($data);
    }
}
