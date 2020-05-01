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
}
