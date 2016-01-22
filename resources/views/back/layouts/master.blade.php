<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('back/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('back/css/owl.carousel.css')}}" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('back/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('back/css/style-responsive.css')}}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>

<section id="container" >
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
        </div>
        <!--logo start-->
        <a href="{{url('/')}}" class="logo">数据<span>标定平台</span></a>
        <!--logo end-->

        <div class="top-nav ">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img src="{{asset('imgs/photo.jpg')}}" alt="" style='height:20px;width:auto;'>
                        <span class="username">{{\Auth::user()->name}}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><a id="logout" href="#"><i class="icon-key"></i>退出登陆</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <form id="logout_form" action="{{url('/u/logout')}}" method="GET">
                {!! csrf_field() !!}
            </form>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="@yield('dashboard')" href="{{url('admin')}}">
                        <i class="icon-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(\Auth::user()->isAdmin())


                    <li class="sub-menu">
                        <a class="@yield('user')" href="javascript:; ">
                            <i class="icon-user"></i>
                            <span>用户管理</span>
                        </a>
                        <ul class="sub">
                            <li class="@yield('user_man')"><a   href="{{url('admin/user')}}">用户管理</a></li>
                            <li class="@yield('appeal_man')"><a   href="{{url('admin/user/appeals')}}">申诉管理</a></li>
                        </ul>
                    </li>


                    <li class="sub-menu">
                        <a href="javascript:; " class="@yield('dataset')">
                            <i class="icon-tasks"></i>
                            <span>数据集管理</span>
                        </a>
                        <ul class="sub">
                            <li class="@yield('create_dataset')"><a   href="{{url('admin/dataset/create')}}">新建数据集</a></li>
                            <li class="@yield('manage_dataset')"><a   href="{{url('admin/dataset')}}">数据集管理</a></li>
                        </ul>
                    </li>
                @endif
                <li class="sub-menu">
                    <a href="javascript:;" class="@yield('goods')">
                        <i class="icon-shopping-cart"></i>
                        <span>积分商城</span>
                    </a>
                    <ul class="sub">
                        @if (\Auth::user()->isAdmin())
                            <li class="@yield('create_goods')"><a  href="{{url('admin/goods/create')}}">新建商品</a></li>
                            <li class="@yield('manage_goods')"><a  href="{{url('admin/goods')}}">商品管理</a></li>
                        @endif
                        <li class="@yield('receive_goods')"><a  href="{{url('admin/goods/receive')}}">领取兑换</a></li>
                        <li class="@yield('received_goods')"><a  href="{{url('admin/goods/received')}}">已领取商品</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="@yield('awards')" >
                        <i class="icon-gift"></i>
                        <span>抽奖</span>
                    </a>
                    <ul class="sub">
                        @if(\Auth::user()->isAdmin())
                            <li class="@yield('create_award')" ><a  href="{{url('admin/award/create')}}">新建奖品</a></li>
                            <li class="@yield('manage_award')"><a  href="{{url('admin/award')}}">奖品管理</a></li>
                            <li class="@yield('lottery')"><a  href="{{url('admin/award/lottery')}}">抽奖盘设置</a></li>
                        @endif
                        <li class="@yield('receive_award')"><a  href="{{url('admin/award/receive')}}">领取奖品</a></li>
                        <li class="@yield('received_award')"><a  href="{{url('admin/award/received')}}">已领取奖品</a></li>
                    </ul>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
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
            @yield('content')
            </section>
    </section>
    <!--main content end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('back/js/jquery.js')}}"></script>
<script src="{{asset('back/js/bootstrap.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{asset('back/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('back/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('back/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{asset('back/js/jquery.sparkline.js')}}" type="text/javascript"></script>
<script src="{{asset('back/js/owl.carousel.js')}}" ></script>
<script src="{{asset('back/js/jquery.customSelect.min.js')}}" ></script>
<script src="{{asset('back/js/respond.min.js')}}" ></script>

<script class="include" type="text/javascript" src="{{asset('back/js/jquery.dcjqaccordion.2.7.js')}}"></script>

<!--common script for all pages-->
<script src="{{asset('back/js/common-scripts.js')}}"></script>
<script type="application/javascript">
    $('#logout').on('click', function(){
        $('#logout_form').submit();
    });
</script>
<!--script for this page-->
@yield('script')
</body>
</html>
