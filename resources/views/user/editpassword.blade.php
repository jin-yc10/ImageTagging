@extends('layouts.master')

@section('title', '数据标注平台｜修改密码')
@section('user', 'active')
<style type="text/css">
    .panel {
        border: none;
        box-shadow: none;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
        box-shadow: 0 1px 1px rgba(0,0,0,0.05);
    }
    .panel-heading {
        border-color: #eff2f7;
        font-size: 16px;
        font-weight: 300;
    }

</style>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    修改登陆密码
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{url('/u/editpassword')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="oldPassword" class="col-lg-2 col-sm-2 control-label">原始密码:</label>
                            <div class="col-lg-10">
                                <input name="oldPassword" type="password" class="form-control" id="oldPassword" placeholder="请输入原始登陆密码" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" class="col-lg-2 col-sm-2 control-label">新&nbsp;&nbsp;密&nbsp;&nbsp;码:</label>
                            <div class="col-lg-10">
                                <input name="newPassword" type="password" class="form-control" id="newPassword" placeholder="请输入新密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPassword_confirmation" class="col-lg-2 col-sm-2 control-label">确认密码:</label>
                            <div class="col-lg-10">
                                <input name="newPassword_confirmation" type="password" class="form-control" id="newPassword_confirmation" placeholder="请再次输入新密码">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-danger">确认修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection