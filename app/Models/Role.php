<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Base
{
    // 角色与权限，多对多
    public function nodes()
    {
        // 关联模型，中间表，本模型对应的外键id,关联模型对应的外键id
        return $this->belongsToMany(Node::class, 'role_node', 'role_id', 'node_id');
    }

}
