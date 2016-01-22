@extends('back.layouts.master')
@section('title','数据标定平台｜用户管理')
@section('user','active')
@section('user_man','active')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                用户管理
            </header>
            <table class="table table-striped table-advance table-hover">
                <thead>
                <tr>
                    <th><i class="icon-bookmark"></i>ID</th>
                    <th><i class="icon-user"></i>姓名</th>
                    <th><i class="icon-envelope"></i>邮箱</th>
                    <th><i class="icon-star"></i>积分</th>
                    <th><i class="icon-time"></i>注册时间</th>
                    <th><i class=" icon-gears"></i>操作</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><a href="#">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td><span class="label label-warning label-mini">{{$user->points}}</span></td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            @if ($user->is_locked)
                                <a href="{{url('admin/user/'.$user->id."/unlock")}}" class="btn btn-default btn-xs"><i class="icon-unlock">解锁</i></a>
                            @else
                                <a href="{{url('admin/user/'.$user->id."/lock")}}" class="btn btn-success btn-xs"><i class="icon-lock">锁定</i></a>
                            @endif
                            @if ($user->is_admin)
                                <a href="{{url('admin/user/'.$user->id."/deladmin")}}" class="btn btn-default btn-xs"><i class="icon-star-empty">非管理员</i></a>
                            @else
                                <a href="{{url('admin/user/'.$user->id."/add2admin")}}" class="btn btn-primary btn-xs"><i class="icon-star">管理员</i></a>
                            @endif
                            @if ($user->is_reception)
                                <a href="{{url('admin/user/'.$user->id."/delreception")}}" class="btn btn-default btn-xs"><i class="icon-user">非前台</i></a>
                            @else
                                <a href="{{url('admin/user/'.$user->id."/add2reception")}}" class="btn btn-info btn-xs"><i class="icon-desktop">前台</i></a>
                            @endif
                            <a href="{{url('admin/user/'.$user->id."/destroy")}}" onClick="return confirm('{{"确认要删除用户".$user->name."么？"}}');" class="btn btn-danger btn-xs"><i class="icon-trash ">删除</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $users->render() !!}
        </section>
    </div>
</div>
@endsection

@section('script')
@endsection
