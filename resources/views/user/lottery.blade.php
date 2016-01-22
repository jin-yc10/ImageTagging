@extends('layouts.master')

@section('title', '数据标注平台｜已购买商品')
@section('user', 'active')
<style type="text/css">
    .lottery_right{
        left: auto;
        right: -150px;
        text-align: left;
        position: absolute;
        top: 50px;
    }
    .lottery_left{
        right: auto;
        left: -150px;
        text-align: right;
        position: absolute;
        top: 50px;
    }
</style>
<script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.more_label').click(
                function(){
                    if ($(this).prev().css('display') == 'none'){
                        $(this).prev().css('display','inline');
                        $(this).html('收起');
                    }
                    else{
                        $(this).prev().css('display','none');
                        $(this).html('点击查看更多');
                    }
                }
        );
    });
</script>
<link href="{{asset('back/css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body">
                    <div class="text-center mbot30">
                        <h3 class="timeline-title">夺宝商品</h3>
                        <p class="t-info">以下是所有您参与夺宝商品的信息</p>
                    </div>


                    <?php
                        function cmp($a, $b) {
                            if ($a->token == $b->token) {
                                return 0;
                            }
                            return ($a->token < $b->token) ? -1 : 1;
                        }
                        $lotteryUser = $user->LotteryUser()->orderBy('updated_at','desc')->get();
                        $lotteryRecord = Array();

                        foreach($lotteryUser as $lu ){

                            $biglottery = $lu->BigLottery;
                            if (!isset($lotteryRecord[$biglottery->id])){
                                $lotteryRecord[$biglottery->id] = Array($lu);
                            }
                            else{
                                array_push($lotteryRecord[$biglottery->id],$lu);
                            }
                        }
                        $index = 0;
                    ?>

                    @foreach($lotteryRecord as $lu_array)
                        <div class="timeline">
                            <article class="timeline-item {{ ++$index % 2 == 0 ? 'alt' : ''}}">
                                <div class="timeline-desk">
                                    <div class="panel">
                                        <div class="panel-body" style="min-height: 150px;">
                                            <span class="arrow"></span>
                                            <?php
                                                $lu = $lu_array[0];
                                                uasort($lu_array,'cmp');
                                                $colors = ['blue','green','light-green',
                                                           'purple'];
                                                $color = $colors[$index % 4];
                                            ?>
                                            <span class="timeline-icon {{$color}}"></span>

                                            <span class="timeline-date">{{$lu->BigLottery->name}}</span>
                                            <div class="{{ $index % 2 == 0 ? 'lottery_right' : 'lottery_left'}}">
                                                <a href="#">
                                                    <img alt="" src="{{asset($lu->BigLottery->image_path)}}" style="height:100px;width:auto;">
                                                </a>
                                            </div>

                                            <h1 class="{{$color}}">参与次数:<span style="color:red">{{count($lu_array)}}</span></h1>
                                            <p >
                                                <span class="less_data">
                                                    @foreach(array_slice($lu_array,0,100) as $lu)
                                                        {{$lu->token}}
                                                    @endforeach

                                                </span>
                                                <span class="more_data" style="display: none;">
                                                    @foreach(array_slice($lu_array,100) as $lu)
                                                        {{$lu->token}}
                                                    @endforeach
                                                </span>
                                                @if(count($lu_array) > 100)
                                                    <a class="more_label"  style='color:blue;'>点击查看更多</a>
                                                @endif
                                            </p>

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