@extends('back.layouts.dashboard')
@section('page_heading','所有已兑换商品')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>商品名称</th>
                <th>商品图片</th>
                <th>兑换人</th>
                <th>兑换时间</th>
            </tr>
            </thead>
            <tbody>

            @foreach($goodsUsers as $goodsUser)
                <tr>
                    <td>{{$goodsUser->Goods->id}}</td>
                    <td>{{$goodsUser->Goods->name}}</td>
                    <td><img src="{{url($goodsUser->Goods->image_path)}}" style="width:80px;"></td>
                    <td>{{$goodsUser->User->name}}</td>
                    <td>{{$goodsUser->updated_at}}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $goodsUsers->render() !!}
    </div>

@endsection