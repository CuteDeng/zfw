@extends('admin.common.main')
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 修改用户
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
{{--        表单验证--}}
        @include('admin.common.validate')
        <form action="{{route('admin.user.edit',['id'=>$model->id])}}" method="post" class="form form-horizontal" id="form-member-add">
{{--            让表单模拟put提交--}}
            @method('PUT')
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$model->truename}}" placeholder="" id="" name="truename" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">账号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    {{$model->username}}
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>原密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" id="spassword" name="spassword">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" id="password" name="password">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">确认密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" id="" name="password_confirmation">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="sex" type="radio" id="sex-1" value="先生" checked>
                        <label for="sex-1">先生</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="sex-2" value="女士" name="sex">
                        <label for="sex-2">女士</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$model->phone}}" placeholder="" id="mobile" name="phone">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="@" value="{{$model->email}}" name="email" id="email">
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
        // 单选框样式
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        // 表单验证
        $("#form-member-add").validate({
            rules: {
                truename: {
                    required: true
                },
                username: {
                    required: true
                },
                // password: {
                //     required: true
                // },
                spassword: {
                    required: true
                },
                password_confirmation: {
                    // required: true,
                    equalTo: '#password'
                },
                email: {
                    email: true
                },
                phone: {
                    phone: true
                }
            },
            messages: {
                truename: {
                    required: '姓名不能为空'
                },
            },
            onkeyup: false,
            success: "valid",
            // 通过后的处理方法
            submitHandler: function (form) {
                form.submit();
            }
        });
        // 自定义验证规则
        jQuery.validator.addMethod("phone", function (value, element) {
            var reg = /(\+86-)?1[3-9]\d{9}$/;
            return this.optional(element) || reg.test(value);
        }, '请输入正确的手机号')

    </script>
@endsection
