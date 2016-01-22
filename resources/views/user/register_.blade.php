<!DOCTYPE html>
<html>
<head>
    <title>注册</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrapValidator.css")}}"/>
    <link href="{{asset('back/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('back/css/style-responsive.css')}}" rel="stylesheet" />

    <!-- Include the FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
    <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />-->

    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrapValidator.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <!-- form: -->
        <section>
            <div class="col-lg-8 col-lg-offset-2">
                <form id="defaultForm" method="post" class="form-signin" action="{{url('/u/register')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h2 class="form-signin-heading">立即注册</h2>
                    @if(Session::has('flash_message'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{ Session::get('flash_message') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')

                    <div class="login-wrap">
                        <p>在下面输入你的个人信息</p>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="name" placeholder="真实姓名" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="email" placeholder="登陆邮箱"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" name="password" placeholder="登陆密码" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-login btn-block" type="submit">注册</button>
                            </div>
                        </div>
                        <div class="registration">
                            已经注册过了
                            <a class="" href="{{url('u/login')}}">
                                登陆
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- :form -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
            message: 'This value is not valid',

            fields: {
                name: {
                    message: 'The name is not valid',
                    validators: {
                        notEmpty: {
                            message: '真实姓名不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: '真实姓名至少2个字'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: '登陆邮箱不能为空'
                        },
                        emailAddress: {
                            message: '请输入有效的邮箱地址'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '登陆密码不能为空'
                        },
                        identical: {
                            field: 'confirmPassword',
                            message: '两次输入密码不一致'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: '密码长度不能少于6位'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: '确认密码不能为空'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: '密码长度不能少于6位'
                        },
                        identical: {
                            field: 'password',
                            message: '两次密码输入不一致'
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>