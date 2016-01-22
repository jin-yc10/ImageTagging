@extends('layouts.master')

@section('title', '数据标注平台｜中奖情况')
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
                        <h3 class="timeline-title">扣分记录</h3>
                        <p class="t-info">以下是您所有因标注结果不正确导致扣分的时间轴</p>
                        <p class="t-info">(标注结果通过多人标注,进行投票确定,如果您对标注结果有疑问,可以通过申诉找回积分)</p>
                    </div>

                @foreach($wrongItems as $index => $wrongItem)
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
                                        <span class="timeline-date">{{$wrongItem->updated_at->format('H:i')}}</span>
                                        <h1 class="{{$color}}">{{$wrongItem->updated_at->format("Y年m月d日")}}</h1>
                                        <p>正确标注:<a href="#" class="red">{{$wrongItem->ItemUserRelation->label == 1 ? '不是' : '是'}}</a>;您给的标注结果:<a href="#" class="red">{{$wrongItem->ItemUserRelation->label == 1 ? '是' : '不是'}}</a></p>
                                        <p>扣除积分1分.
                                            @if ($wrongItem->is_appeal)
                                                @if($wrongItem->is_appeal_passed == -1 )
                                                    <a href="#">申诉审核中</a>
                                                @elseif($wrongItem->is_appeal_passed == 1)
                                                    <a href="#">申诉成功.您被扣除的积分已返回到您的账户</a>
                                                @elseif ($wrongItem->is_appeal_passed == 0)
                                                    <a href="#">申诉失败.很抱歉,经专家再次判定,您的标注结果依然被认为是错误的.</a>
                                                @endif

                                            @else
                                                <a href="{{url('/u/appeal/'.$wrongItem->id)}}" style="color:#428bca">申诉</a>
                                            @endif

                                        </p>
                                        <div class="album">
                                            <a href="#" style="color:black;">
                                                <img alt="" src="{{asset($wrongItem->ItemUserRelation->Item->StandardItem->path)}}" style="height:100px;width:auto;"><p>标准图片</p>
                                            </a>
                                            <a href="#" style="color:black;">
                                                <img alt="" src="{{asset($wrongItem->ItemUserRelation->Item->path)}}" style="height:100px;width:auto;"><p>被标注图片</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                @endforeach
                    {!! $wrongItems->render() !!}

                    <div class="clearfix">&nbsp;</div>
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>
@endsection