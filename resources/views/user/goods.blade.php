@extends('layouts.master')

@section('title', '数据标注平台｜已购买商品')
@section('user', 'active')

<link href="{{asset('back/css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body">
                    <div class="text-center mbot30">
                        <h3 class="timeline-title">兑换商品</h3>
                        <p class="t-info">以下是您所有兑换商品的时间轴</p>
                    </div>
                    @foreach($user->GoodsUser()->orderBy('updated_at','desc')->get() as $index => $goodsUser)
                        <div class="timeline">
                            <article class="timeline-item {{ $index % 2 == 0 ? 'alt' : ''}}">
                                <div class="timeline-desk">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <span class="arrow"></span>
                                            <?php
                                                $colors = ['blue','green','light-green',
                                                           'purple'];
                                                $color = $colors[rand(0,3)];
                                            ?>
                                            <span class="timeline-icon {{$color}}"></span>
                                            <span class="timeline-date">{{$goodsUser->updated_at->format('H:i')}}</span>
                                            <h1 class="{{$color}}">{{$goodsUser->updated_at->format("Y年m月d日")}}</h1>
                                            <p>{{$goodsUser->is_gotten ? '领取商品' : '兑换商品'}}：<span ><a href="#" class="red">{{$goodsUser->Goods->name}}</a> </span></p>
                                            <div class="album">
                                                <a href="#">
                                                    <img alt="" src="{{asset($goodsUser->Goods->image_path)}}" style="height:100px;width:auto;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach

                    <div class="clearfix">&nbsp;</div>
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>
@endsection