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
        <form method="get" class="text-c" onsubmit="return dopost()">
            日期范围：
            <input type="date"  id="datemin" class="input-text Wdate" style="width:120px;">
            -
            <input type="date" id="datemax" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" value="{{request()->get('title')}}"
                   placeholder="输入文章标题" id="title">
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
        var dtable = $(".table-sort").DataTable({
            // 下拉框分页列表
            lengthMenu: [5, 10, 15, 20, 100],
            // 隐藏搜索框
            searching: false,
            // 第三列不进行排序
            columnDefs: [
                {
                    targets: [3],
                    orderable: false
                }
            ],
            // 开启ajax,进行服务端分页
            serviceSide: true,
            ajax: {
                url: '{{route('admin.article.index')}}',
                type: 'get',
                // 动态获取dom节点的value
                data: function (ret) {
                    ret.datemin = $("#datemin").val();
                    ret.datemax = $("#datemax").val();
                    ret.title = $.trim($("#title").val());
                }
            },
            // 指定每列显示的数据
            columns: [
                // 格式：{data:'',defaultContent:'',className:''}
                {data: 'id', className: 'text-c'},
                {data: 'title'},
                {data: 'created_at'},
                {data: 'action', defaultContent: 'test'}
            ]
        });
        function dopost() {
            dtable.ajax.reload();
            return false;
        }
    </script>
@endsection
