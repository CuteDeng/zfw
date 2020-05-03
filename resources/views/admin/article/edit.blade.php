@extends('admin.common.main')
@section('css')
    <link rel="stylesheet" href="/webuploader/webuploader.css">
@endsection
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 文章管理
        <span class="c-gray en">&gt;</span> 修改文章
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    @include('admin.common.validate')
    <article class="page-container">
        <form action="{{route('admin.article.update',$article)}}" ref="frm" class="form form-horizontal">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>标题：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" v-model="info.title" name="title">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>摘要：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" v-model="info.desc" name="desc">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>封面：</label>
                <div class="formControls col-xs-8 col-sm-5">
                    {{--                    <input type="file" class="input-text" name="pic">--}}
                    {{--                    表单上传提交时的封面地址--}}
                    <input type="hidden" id="pic" name="pic">
                    <div id="picker">上传封面</div>
                </div>
                <div class="formControls col-xs-4 col-sm-4">
                    <img :src="info.pic" id="img" alt="" style="width: 100px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>内容：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="body" id="body" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" @click="dopost" value="修改">
                </div>
            </div>
        </form>
    </article>
@endsection

@section('js')
    <script src="/webuploader/webuploader.js"></script>
    <script src="/ueditor/ueditor.config.js"></script>
    <script src="/ueditor/ueditor.all.js"></script>
    <script src="/js/vue.js"></script>
    <script>
        new Vue({
            el: '.page-container',
            data: {
                info:{!! $article !!}
            },
            // 组件挂载完毕，dom渲染完成
            mounted() {
                // 富文本编辑器
                this.editor = UE.getEditor('body', {
                    initialFrameHeight: 300
                });
                // 渲染完毕，设置富文本内容
                this.editor.addListener("ready", () => {
                    this.editor.setContent(this.info.body)
                });
                // 上传插件
                this.uploader = WebUploader.create({
                    // 选择完文件后是否自动上传
                    auto: true,
                    // swf文件路径
                    swf: '/webuploader/Uploader.swf',
                    // 文件接收服务端。
                    server: '{{route('admin.article.upfile')}}',
                    // 文件上传参数
                    formData: {
                        _token: '{{csrf_token()}}'
                    },
                    // 文件上传时的表单域名称
                    fileVal: 'file',
                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: {
                        id: '#picker',
                        // 关闭多文件上传
                        multiple: false,
                    },
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: true
                });
                // 回调方法
                this.uploader.on('uploadSuccess', (file, ret) => {
                    let src = ret.url;
                    this.info.pic = src;
                });
            },
            methods: {
                // 使用js方式提交表单
                async dopost() {
                    // 更新一下富文本的内容
                    this.info.body = this.editor.getContent();
                    //json转换成字符串
                    var frmData = JSON.stringify(this.info);
                    console.log(frmData)
                    // fetch 方式发送ajax
                    let ret = await fetch(this.$refs.frm.action, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                            'Content-Type': 'application/json'
                        },
                        body: frmData
                    });
                    let json = await ret.json();
                    location.href = json.url;
                }
            }
        })

    </script>
@endsection
