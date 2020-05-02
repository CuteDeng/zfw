<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Btn;

class Base extends Model
{
    use SoftDeletes, Btn;
    // 设置软删除
    protected $dates = ['deleted_at'];
    // 设置添加时的黑名单
    protected $guarded = [];

    // 获取树中的所有节点和层级
    public function treeLevel(array $data, int $pid = 0, string $html = '--', int $level = 0)
    {
        static $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {
                $val['html'] = str_repeat($html, $level * 2);
                $val['level'] = $level + 1;
                $arr[] = $val;
                $this->treeLevel($data, $val['id'], $html, $val['level']);
            }
        }
        return $arr;
    }

    // 获取树状结构的节点
    public function subTree(array $data, int $pid = 0)
    {
        $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {
                $val['sub'] = $this->subTree($data, $val['id']);
                $arr[] = $val;
            }
        }
        return $arr;
    }
}
