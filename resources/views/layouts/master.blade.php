<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('back/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/theme.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>

      <script src="{{asset('js/html5shiv.js')}}" type="text/javascript"></script>
      <script src="{{asset('js/respond.min.js')}}" type="text/javascript"></script>
    <![endif]-->
  </head>
  <style type="text/css">
      html {
          position: relative;
          min-height: 100%;
      }
      #footer {
          position: absolute;
          bottom: 0;
          width: 100%;
          /* Set the fixed height of the footer here */
          height: 170px;
      }
      #push {
          height: 170px; /* .push must be the same height as .footer */
      }
      .points a:hover{
          background-color: white;
      }
  </style>

  <body>
    <!--header start-->
    <header class="header-frontend">
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}"><img style="width:40px;" src="{{asset('imgs/icon.png')}}"/>数据<span>标注平台</span></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav pull-left">
                        <li class="@yield('index')" style="margin-left:40px;"><a href="{{url('/')}}">首页</a></li>
                        <li class="@yield('tag')"><a href="{{url('/tag/'.DB::table('datasets')->first()->id)}}">数据标注</a></li>
						<li class="@yield('goods')"><a href="{{url('/gl/goods')}}">积分商城</a></li>
                        <li class="@yield('lottery')"><a href="{{url('/gl/lottery')}}">抽奖</a></li>
                        <li class="@yield('biglottery')"><a href="{{url('/gl/biglottery')}}">积分夺宝</a></li>
                        @if( Auth::check() && (Auth::user()->isAdmin() or Auth::user()->isReception()))
                            <li><a href="{{url('admin')}}">后台管理</a></li>
                        @endif
                        @if(Auth::check())
                        <li class="dropdown @yield('user')">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">个人中心 <b class=" icon-angle-down"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/u/profile/')}}">个人信息</a></li>
                                <li><a href="{{url('/u/editpassword')}}">修改密码</a></li>
                                <li><a id="logout" href="#">退出登陆</a></li>
                            </ul>
                        </li>
                        @if(Auth::check())
                            <li ><a >当前积分:<span style="color:red" id="points">{{Auth::user()->points}}</span></a></li>
                        @endif
                        @else
                            <li class="@yield('user')"><a href="{{url('u/login')}}">登陆</a></li>
                        @endif
                    </ul>

                    <form id="logout_form" action="{{url('/u/logout')}}" method="GET">
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--header end-->
    <!--container start-->
    <div id="wrap" class="container">
        <div class="row">
            @if(Session::has('flash_message'))
                <div class="alert alert-success fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                    </button>
                    {{ Session::get('flash_message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
        </div>
        @yield('content')
        <div id="push"></div>
    </div>


     <!--container end-->

    <!--footer start-->
    <footer id="footer" class="footer navbar-static-bottom" style='padding-top:10px;'>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-3">
                    <h1>联系方式</h1>
                    <address>
                        <p>地址: 江苏省无锡市新区太科园大学科技园立业楼A区2楼</p>
                        <p>联系电话 : (123) 456-7890</p>
                        <p>邮箱 : <a href="javascript:;">support@vectorlab.com</a></p>
                    </address>
                </div>
            </div>
        </div>
    </footer>
    <!--footer end-->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('back/js/jquery.js')}}"></script>

    <script src="{{asset('back/js/bootstrap.min.js')}}"></script>


    <script type="application/javascript">
        $('#logout').on('click', function(){
            $('#logout_form').submit();
        });
    </script>
    @yield('script');
  </body>
</html>
