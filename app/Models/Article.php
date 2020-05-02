<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Base
{
    // 给模型追加一个数据库不存在的字段
    protected $appends = ['action'];
    // 给该字段设置访问器
    public function getActionAttribute()
    {
        return $this->editBtn('admin.article.edit') .'&nbsp;'. $this->delBtn('admin.article.destroy');
    }
}
