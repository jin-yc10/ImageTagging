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

                            <button type="button" data-userid="{{$user->id}}" data-points="{{$user->points}}" data-name="{{$user->name}}" data-toggle="modal" data-target="#editpoints"  role="button" class="btn btn-primary btn-xs"><i class="icon-pencil">修改积分</i></button>
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
    <div class="modal fade" id="editpoints" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">修改用户积分</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/user/update')}}" role="form" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" class="control-label">姓名</label>
                                <input name="name" type="text" class="form-control" id="name" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="points" class="control-label">积分</label>
                                <input name="points" type="text" class="form-control" id="points">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"  value="修改">
                                <input type="reset" class="btn btn-default" data-dismiss="modal" value="取消">

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#editpoints').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('userid') // Extract info from data-* attributes
            var points = button.data('points');
            var name = button.data('name');
            $('#id').val(userid);
            $('#name').val(name);
            $('#points').val(points);
        })

    </script>
@endsection
