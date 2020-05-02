@extends('admin.common.main')
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 文章管理
        <span class="c-gray en">&gt;</span> 文章列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    @include('admin.common.msg')
    <div class="page-container">
        <form method="get" class="text-c">
            <input type="text" class="input-text" style="width:250px" value="{{request()->get('name')}}"
                   placeholder="输入文章标题" id="" name="name">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜文章
            </button>
        </form>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="{{route('admin.article.create')}}" class="btn btn-primary radius"><i
                    class="Hui-iconfont">&#xe600;</i> 添加文章</a>
        </span>
            <span class="r">共有数据：<strong>88</strong> 条</span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="100">文章标题</th>
                    <th width="130">加入时间</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="text-c">
                        <td>{{$item['id']}}</td>
                        <td class="text-l">{{$item->title}}</td>
                        <td>{{$item['created_at']}}</td>
                        <td class="td-manage">
                            <a href="{{route('admin.node.edit',['id'=>$item['id']])}}"
                               class="label label-success radius">修改</a>
                            <a href="{{route('admin.node.destroy',['id'=>$item['id']])}}"
                               class="label label-warning radius">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script !src="">
        $(".table-sort").DataTable({
            // 第三列不进行排序
            columnDefs: [
                {
                    targets: [3],
                    orderable: false
                }
            ]
        });
    </script>
@endsection
