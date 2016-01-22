@extends('back.layouts.dashboard')
@section('page_heading','控制面板')
@section('section')

        <!-- /.row -->
<div class="col-sm-12">
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$newGoods}}</div>
                            <div>新增兑换商品</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('back/goods/receive')}}">
                    <div class="panel-footer">
                        <span class="pull-left">查看详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$newAwards}}</div>
                            <div>新增抽奖</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url ('back/award/receive') }}">
                    <div class="panel-footer">
                        <span class="pull-left">查看详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
