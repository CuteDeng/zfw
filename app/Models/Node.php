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
}
