@extends('layouts.master')

@section('title', '数据标注平台｜个人信息')
@section('user', 'active')
<link href="{{asset('back/css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!--widget start-->
            <section class="panel">
                <div class="twt-feed blue-bg">
                    <h1>{{$user->name}}</h1>
                    <p>{{$user->email}}</p>
                    <a href="#">
                        <img src="{{asset('imgs/photo.jpg')}}" alt="">
                    </a>
                </div>
            </section>
            <div class="weather-category twt-category" style="margin-top:20px;">
                <ul>
                    <li class="active">
                        <h5>&nbsp;</h5>
                    </li>
                    <li style="padding-left:30px;">
                        <h5>{{$user->points}}</h5>
                        总积分
                    </li>
                    <li>
                        <h5></h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div >
        <div class="row state-overview">
            <a href="{{url('/u/goods')}}">
                <div class="col-lg-3 col-sm-3">
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="icon-shopping-cart"></i>
                        </div>
                        <div class="value" style="font-size:30px;">
                            <h1 class="count">
                                {{$user->Goods()->count()}}
                            </h1>
                            <p>兑换商品</p>
                        </div>
                    </section>
                </div>
            </a>
            <a href="{{url('/u/awards')}}">
                <div class="col-lg-3 col-sm-3">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="icon-gift"></i>
                        </div>
                        <div class="value" style="font-size:30px;">
                            <h1 class=" count">
                                {{$user->Award()->count()}}
                            </h1>
                            <p>中奖商品</p>
                        </div>
                    </section>
                </div>
            </a>
            <a href="{{url('/u/lottery')}}">
                <div class="col-lg-3 col-sm-3">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="icon-archive"></i>
                        </div>
                        <div class="value" style="font-size:30px;">
                            <h1 class=" count">
                                {{$user->LotteryCount()}}
                            </h1>
                            <p>夺宝商品</p>
                        </div>
                    </section>
                </div>
            </a>
            <a href="{{url('/u/wrongitem')}}">
                <div class="col-lg-3 col-sm-3">
                    <section class="panel">
                        <div class="symbol" style="background: #0099FF">
                            <i class="icon-archive"></i>
                        </div>
                        <div class="value" style="font-size:30px;">
                            <h1 class=" count">
                                {{$user->WrongItem()->count()}}
                            </h1>
                            <p>扣分记录</p>
                        </div>
                    </section>
                </div>
            </a>
        </div>
    </div>
@endsection