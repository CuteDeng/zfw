@extends('admin.common.main')
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 角色列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    @include('admin.common.msg')
    <div class="page-container">
        <form method="get" class="text-c">
            <input type="text" class="input-text" style="width:250px" placeholder="输入角色名称" id="" name="name">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜角色
            </button>
        </form>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="{{route('admin.role.create')}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a>
        </span>
            <span class="r">共有数据：<strong>88</strong> 条</span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="100">角色名称</th>
                    <th width="100">查看权限</th>
                    <th width="130">加入时间</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="text-c">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td><a href="#" class="label label-success radius">权限</a></td>
                        <td>{{$item->created_at}}</td>
                        <td class="td-manage">
                            <a href="{{route('admin.role.edit',['id'=>$item->id])}}" class="label label-success radius">修改</a>
                            <a href="{{route('admin.role.destroy',['id'=>$item->id])}}" class="label label-warning radius">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--            分页--}}
            {{$data->links()}}
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
        let _token = "{{csrf_token()}}";
        $(".delbtn").click(function () {
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                data: {_token},
                type: 'DELETE',
                dataType: 'json'
            }).then(ret => {
                if (ret.status == 0) {
                    layer.msg(ret.message, {time: 2000, icon: 1}, () => {
                        $(this).parents('tr').remove();
                    })
                }
            });
            return false;
        });

        function deleteAll() {
            layer.confirm('确定删除吗？', {
                btn: ['确认删除', '思考一下']
            }, () => {
                let ids = $('input[name="id[]"]:checked');
                let id = [];
                $.each(ids, (key, val) => {
                    // $(val) 将dom元素转换为jquery对象
                    id.push($(val).val());
                });
                $.ajax({
                    url: "{{route('admin.user.delall')}}",
                    data: {id, _token},
                    type: "DELETE",
                }).then(ret => {
                    if (ret.status == 0) {
                        layer.msg(ret.message, {time: 2000, icon: 1}, () => {
                            location.reload()
                        })
                    }
                });
            });
        }
    </script>
@endsection
