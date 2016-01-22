@extends('back.layouts.master')
@section('title','数据标定平台｜已领取兑换商品')
@section('goods','active')
@section('received_goods','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    已领取兑换商品
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>商品名称</th>
                        <th><i class="icon-picture"></i>商品图片</th>
                        <th><i class="icon-user"></i>兑换人</th>
                        <th><i class=" icon-time"></i>领取时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goodsUsers as $goodsUser)
                        <tr>
                            <td>{{$goodsUser->Goods->id}}</td>
                            <td><a href="#">{{$goodsUser->Goods->name}}</a></td>
                            <td><img src="{{url($goodsUser->Goods->image_path)}}" style="width:80px;"></td>
                            <td>{{$goodsUser->User->name}}</td>
                            <td>{{$goodsUser->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $goodsUsers->render() !!}
            </section>
        </div>
    </div>
@endsection

@section('script')
@endsection
