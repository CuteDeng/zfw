@extends('admin.common.main')
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 修改角色
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
        <form action="{{route('admin.role.update',$model)}}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" id="" value="{{$model->name}}" name="name">
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>
@endsection

@section('js')
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script>
        // 表单验证
        $("#form-member-add").validate({
            rules: {
                name: {
                    required: true
                }
            },
            onkeyup: false,
            success: "valid",
            // 通过后的处理方法
            submitHandler: function (form) {
                let url = $(form).attr('action');
                // 表单序列化
                let data = $(form).serialize();
                $.ajax({
                    url:url,
                    data:data,
                    type: 'PUT'
                }).then(({status,message}) => {
                    if(status == 0){
                        layer.msg(message,{time:2000,icon:1},()=>{
                            location.href = "{{route('admin.role.index')}}"
                        })
                    }else{
                        layer.msg(message,{time:2000,icon:2});
                    }
                });
            }
        });

    </script>
@endsection
