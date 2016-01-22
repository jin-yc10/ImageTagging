@extends('back.layouts.dashboard')
@section('page_heading','领取兑换商品')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>商品名称</th>
                <th>商品图片</th>
                <th>兑换人</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($goodsUsers as $goodsUser)
                <tr>
                    <td>{{$goodsUser->Goods->id}}</td>
                    <td>{{$goodsUser->Goods->name}}</td>
                    <td><img src="{{url($goodsUser->Goods->image_path)}}" style="width:80px;"></td>
                    <td>{{$goodsUser->User->name}}</td>
                    <td>
                        <a href="{{url('back/goods/'.$goodsUser->id."/gotten")}}" onClick="return confirm('{{"确认要兑换商品".$goodsUser->Goods->name."？"}}');" role="button" class="btn btn-primary btn-outline">兑换</a>
                        <a href="{{url('back/goods/'.$goodsUser->id."/cancel")}}" onClick="return confirm('{{"确认要取消兑换商品".$goodsUser->Goods->name."？"}}');" role="button" class="btn btn-primary btn-outline">取消兑换</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $goodsUsers->render() !!}
    </div>

@endsection