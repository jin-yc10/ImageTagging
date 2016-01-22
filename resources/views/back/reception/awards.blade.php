@extends('back.reception.dashboard')
@section('page_heading','领取抽奖')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>商品名称</th>
                <th>商品图片</th>
                <th>中奖人</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($awardUsers as $awardUser)
                <tr>
                    <td>{{$awardUser->Award->id}}</td>
                    <td>{{$awardUser->Award->name}}</td>
                    <td><img src="{{url($awardUser->Award->image_path)}}" style="width:80px;"></td>
                    <td>{{$awardUser->User->name}}</td>
                    <td>
                        <a href="{{url('back/reception/'.$awardUser->id."/receiveaward")}}" onClick="return confirm('{{"确认".$awardUser->User->name."领取奖品？"}}');" role="button" class="btn btn-primary btn-outline">领奖</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $awardUsers->render() !!}
    </div>

@endsection