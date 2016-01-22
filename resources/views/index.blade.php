@extends('layouts.master')

@section('title', '数据标注平台｜首页')
@section('index', 'active')

@section('content')
    <div class="row">
        <!--feature start-->
        <div class="text-center feature-head">
            <h1>欢迎来到数据标注平台</h1>
            <p>您可以在我们平台上选择数据标注任务，做任务，赚积分，在积分商城兑换您喜欢的商品。<br/>
                另外，我们还精心为您提供了抽奖福利，可以通过抽奖环节，使用您的积分赢取我们为您准备的精美大奖。
            </p>
        </div>
        @if (count($datasets) > 0)
        <div class="col-lg-4 col-sm-4">
            <section>
                <a href="{{url('/tag/'.$datasets[0]->id)}}">
                    <div class="f-box">
                        <i class="icon-user"></i>
                        <h2>{{$datasets[0]->name}}</h2>
                    </div>
                </a>
                    <p class="f-text">
                        {{$datasets[0]->description}}
                    </p>

            </section>
        </div>
        @endif
        <div class="col-lg-4 col-sm-4">
            <section>
                <div class="f-box">
                    <i class="icon-food"></i>
                    <h2>食物数据集标注</h2>
                </div>
                <p class="f-text">
                    该数据集的标注任务是判断待标注食物与给定标准食物是否为同一种食物，只需要选择是或者不是即可。标注正确即可获取相应的积分。
                </p>
            </section>
        </div>
        <div class="col-lg-4 col-sm-4">
            <section>
                <div class="f-box">
                    <i class="icon-hand-right"></i>
                    <h2>更多数据集标注</h2>
                </div>
                <p class="f-text">
                    点击查看更多的数据标注任务
                </p>
            </section>
        </div>
        <!--feature end-->
    </div>
@endsection
