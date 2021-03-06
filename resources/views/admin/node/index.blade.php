@extends('admin.common.main')
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 节点列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    @include('admin.common.msg')
    <div class="page-container">
        <form method="get" class="text-c">
            <input type="text" class="input-text" style="width:250px" value="{{request()->get('name')}}"
                   placeholder="输入节点名称" id="" name="name">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜节点
            </button>
        </form>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="{{route('admin.node.create')}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加节点</a>
        </span>
            <span class="r">共有数据：<strong>88</strong> 条</span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="100">节点名称</th>
                    <th width="100">路由别名</th>
                    <th width="130">是否菜单</th>
                    <th width="130">加入时间</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="text-c">
                        <td>{{$item['id']}}</td>
                        <td class="text-l">{{$item['html']}}{{$item['name']}}</td>
                        <td>{{$item['route_name']}}</td>
                        {{--                        // 解析html,不转义--}}
                        {{--                        <td>{!! $item['menu'] !!}</td>--}}
                        <td>
                            @if($item['is_menu'] == '1')
                                <span class="label label-success radius">是</span>
                            @else
                                <span class="label label-danger radius">否</span>
                            @endif
                        </td>
                        {{--                        <td><a href="#" class="label label-success radius">权限</a></td>--}}
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
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
    <script>
    </script>
@endsection
