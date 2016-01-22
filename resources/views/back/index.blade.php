@extends('back.layouts.master')
@section('title','数据标定平台｜后台首页')
@section('dashboard','active')
@section('content')
    <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <a  href="{{url('admin/goods/receive')}}">
                    <div class="symbol terques">
                        <i class="icon-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1 class="count">
                            {{$newGoods}}
                        </h1>
                        <p>新增兑换商品</p>
                    </div>
                </a>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <a  href="{{url('admin/award/receive')}}">
                <div class="symbol red">
                    <i class="icon-gift"></i>
                </div>
                <div class="value">
                    <h1 class=" count2">
                        {{$newAwards}}
                    </h1>
                    <p>新增抽奖</p>
                </div>
                </a>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <a  href="{{url('admin/goods/received')}}">
                <div class="symbol yellow">
                    <i class="icon-shopping-cart"></i>
                </div>
                <div class="value">
                    <h1 class=" count3">
                        {{$receivedGoods}}
                    </h1>
                    <p>已领取商品</p>
                </div>
                </a>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <a  href="{{url('admin/award/received')}}">
                <div class="symbol blue">
                    <i class="icon-gift"></i>
                </div>
                <div class="value">
                    <h1 class=" count4">
                        {{$receivedAwards}}
                    </h1>
                    <p>已领取奖品</p>
                </div>
                </a>
            </section>
        </div>
    </div>
    @if(\Auth::user()->isAdmin())
    <!--state overview end-->
    <div class="row">
        <div class="col-lg-12">
            <!--work progress start-->
            <section class="panel">
                <div class="panel-body progress-panel">
                    <div class="task-progress">
                        <h1>数据集处理进度</h1>
                        <p>&nbsp;</p>
                    </div>

                </div>
                <table class="table table-hover personal-task">
                    <tbody>
                    @if (count($datasets) > 0)
                        <tr>
                            <td>{{$datasets[0]->id}}</td>
                            <td>
                                {{$datasets[0]->name}}
                            </td>
                            <td>
                                <span class="badge bg-important">{{number_format($datasets[0]->completed(),2)}}%</span>
                            </td>

                        </tr>
                    @endif
                    </tbody>
                </table>
            </section>

            <!--work progress end-->
        </div>
    </div>
    @endif

@endsection

@section('script')

@endsection