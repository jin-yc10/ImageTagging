<!DOCTYPE html>
<html>
<head>
    <title>登陆</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrapValidator.css")}}"/>
    <link href="{{asset('back/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('back/css/style-responsive.css')}}" rel="stylesheet" />

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
                <form id="defaultForm" method="post" class="form-signin" action="{{url('/u/login')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h2 class="form-signin-heading">立即登陆</h2>
                    <div class="login-wrap">
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
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="email" placeholder="请输入登陆邮箱"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" name="password" placeholder="请输入登陆密码" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-login btn-block" type="submit">登陆</button>
                            </div>
                        </div>
                        <div class="registration">
                            还没有账户?
                            <a class="" href="{{url('/u/register')}}">
                                立即注册
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
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: '密码长度不能少于6位'
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>