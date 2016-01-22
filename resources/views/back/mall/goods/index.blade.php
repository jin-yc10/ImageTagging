@extends('back.layouts.dashboard')
@section('page_heading','管理积分商品')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>图片</th>
                <th>兑换积分</th>
                <th>数量</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($goods as $good)
                <tr>
                    <td>{{$good->id}}</td>
                    <td>{{$good->name}}</td>
                    <td><img src="{{url($good->image_path)}}" style="width:80px;"></td>
                    <td>{{$good->points}}</td>
                    <td>{{$good->number}}</td>
                    <td>
                        <a href="{{url('back/goods/'.$good->id."/edit")}}" role="button" class="btn btn-primary btn-outline">修改</a>
                        <a href="{{url('back/goods/'.$good->id."/destroy")}}" onClick="return confirm('{{"确认要删除商品".$good->name."么？"}}');" role="button" class="btn btn-primary btn-outline">删除</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $goods->render() !!}
    </div>

@endsection