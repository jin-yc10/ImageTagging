@extends('back.layouts.master')
@section('title','数据标定平台｜领取兑换商品')
@section('goods','active')
@section('receive_goods','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    领取兑换商品
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>商品名称</th>
                        <th><i class="icon-picture"></i>商品图片</th>
                        <th><i class="icon-user"></i>兑换人</th>
                        <th><i class=" icon-gears"></i>操作</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goodsUsers as $goodsUser)
                        <tr>
                            <td>{{$goodsUser->Goods->id}}</td>
                            <td><a href="#">{{$goodsUser->Goods->name}}</a></td>
                            <td><img src="{{url($goodsUser->Goods->image_path)}}" style="width:80px;"></td>
                            <td>{{$goodsUser->User->name}}</td>
                            <td>

                                <a href="{{url('admin/goods/'.$goodsUser->id."/gotten")}}" onClick="return confirm('{{"确认要领取商品".$goodsUser->Goods->name."？"}}');" class="btn btn-primary btn-xs"><i class="icon-pencil ">领取</i></a>
                                <a href="{{url('admin/goods/'.$goodsUser->id."/cancel")}}" onClick="return confirm('{{"确认要取消兑换商品".$goodsUser->Goods->name."？"}}');" class="btn btn-danger btn-xs"><i class="icon-trash ">取消兑换</i></a>
                            </td>
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
