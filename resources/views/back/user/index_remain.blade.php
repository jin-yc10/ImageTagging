@extends('back.layouts.dashboard')
@section('page_heading','管理用户')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        @if ($user->is_locked)
                            <a href="{{url('back/user/'.$user->id."/unlock")}}" role="button" class="btn btn-primary btn-outline">解锁用户</a>
                        @else
                            <a href="{{url('back/user/'.$user->id."/lock")}}" role="button" class="btn btn-primary btn-outline">锁定用户</a>
                        @endif
                        @if ($user->is_admin)
                            <a href="{{url('back/user/'.$user->id."/deladmin")}}" role="button" class="btn btn-primary btn-outline">退出管理员</a>
                        @else
                            <a href="{{url('back/user/'.$user->id."/add2admin")}}" role="button" class="btn btn-primary btn-outline">加入管理员</a>
                        @endif
                        @if ($user->is_reception)
                            <a href="{{url('back/user/'.$user->id."/delreception")}}" role="button" class="btn btn-primary btn-outline">退出前台</a>
                        @else
                            <a href="{{url('back/user/'.$user->id."/add2reception")}}" role="button" class="btn btn-primary btn-outline">加入前台</a>
                        @endif
                        <a href="{{url('back/user/'.$user->id."/destroy")}}" onClick="return confirm('{{"确认要删除用户".$user->name."么？"}}');" role="button" class="btn btn-primary btn-outline">删除</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $users->render() !!}
    </div>

@endsection