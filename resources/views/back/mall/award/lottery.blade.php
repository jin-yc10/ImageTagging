@extends('back.layouts.dashboard')
@section('page_heading','设置抽奖盘')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>奖品名称</th>
                <th>奖品图片</th>
                <th>奖品数量</th>
                <th>中奖率</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($lotterys as $lottery)
                <tr>
                    <td>{{$lottery->id}}</td>
                    <td>{{$lottery->Award->name}}</td>
                    <td><img src="{{url($lottery->Award->image_path)}}" style="width:80px;"></td>
                    <td>{{$lottery->number}}</td>
                    <td>{{$lottery->prob}}</td>
                    <td>
                        <a href="{{url('back/lottery/'.$lottery->id."/edit")}}" role="button" class="btn btn-primary btn-outline">修改</a>
                        <a href="{{url('back/lottery/'.$lottery->id."/destroy")}}" onClick="return confirm('{{"确认从奖盘删除奖品".$lottery->Award->name."？"}}');" role="button" class="btn btn-primary btn-outline">删除</a>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection