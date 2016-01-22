@extends('back.layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">导航栏</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">数据标定平台后台管理系统</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url ('/u/logout') }}"><i class="fa fa-sign-out fa-fw"></i> 退出登陆</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="搜索...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('back') }}"><i class="fa fa-dashboard fa-fw"></i> 控制面板</a>
                        </li>
                        <li >
                            <a href="{{url('back/user')}}"><i class="fa fa-user-md fa-fw"></i> 用户管理</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> 数据集管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('back/dataset/create') }}">新建数据集</a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('back/dataset' ) }}">管理数据集</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i>积分商城<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="#">积分商品<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{url('back/goods/create')}}">添加商品</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/goods')}}">管理商品</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/goods/receive')}}">领取商品</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/goods/sell')}}">所有兑换商品</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">抽奖商品<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{url('back/award/create')}}">添加奖品</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/award')}}">管理奖品</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/award/lottery')}}">管理抽奖盘</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/award/receive')}}">领取奖品</a>
                                        </li>
                                        <li>
                                            <a href="{{url('back/award/received')}}">所有领奖信息</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">
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
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

