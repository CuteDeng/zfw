<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/css/pagination.css"/>
    <title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 用户中心
    <span class="c-gray en">&gt;</span> 用户管理
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
@include('admin.common.msg')
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin"
               class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax"
               class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
        <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户
        </button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="javascript:;" class="btn btn-danger radius" onclick="deleteAll()"><i
                    class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a href="{{route('admin.user.add')}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a>
        </span>
        <span class="r">共有数据：<strong>88</strong> 条</span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="100">真实名</th>
                <th width="100">角色</th>
                <th width="100">用户名</th>
                <th width="40">性别</th>
                <th width="90">手机</th>
                <th width="150">邮箱</th>
                <th width="130">加入时间</th>
                <th width="70">状态</th>
                <th width="130">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr class="text-c">
                    <td>
                        @if(auth()->id() != $item->id)
                            @if($item->deleted_at == null)
                                <input type="checkbox" value="{{$item->id}}" name="id[]">
                            @endif
                        @endif
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->truename}}</td>
                    <td>{{$item->role->name}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->sex}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->created_at}}</td>
                    <td class="td-status"><span class="label label-success radius">已启用</span></td>
                    <td class="td-manage">
                        <a href="{{route('admin.user.role',$item)}}" class="label label-success radius">分配角色</a>
                        {!! $item->editBtn('admin.user.edit') !!}
{{--                        <a href="{{route('admin.user.edit',['id'=>$item->id])}}" class="label label-success radius">修改</a>--}}
                        @if(auth()->id() != $item->id)
                            @if($item->deleted_at != null)
                                <a href="{{route('admin.user.restore',['id'=>$item->id])}}"
                                   class="label label-warning radius">还原</a>
                            @else
{{--                                <a href="{{route('admin.user.del',['id'=>$item->id])}}"--}}
{{--                                   class="label label-danger radius delbtn">删除</a>--}}
                                {!! $item->delBtn('admin.user.del') !!}
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--            分页--}}
        {{$data->links()}}
    </div>
</div>
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
</body>
</html>
