@extends('admin.common.main')
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 给用户分配角色
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    @include('admin.common.validate')
    <form action="{{route('admin.user.role',$user)}}" method="post">
        @csrf
        @foreach($roleAll as $item)
            <div>
                <label for=""> {{$item->name}}
                    <input type="radio" name="role_id" value="{{$item->id}}"
                           @if($item->id == $user->role_id) checked @endif
                    >
                </label>
            </div>
        @endforeach
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;给用户分配角色&nbsp;&nbsp;">
            </div>
        </div>
    </form>
@endsection

@section('js')
@endsection
