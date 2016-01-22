@extends('back.layouts.dashboard')
@section('page_heading','所有领奖信息')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>奖品名称</th>
                <th>奖品图片</th>
                <th>中奖人</th>
                <th>领取时间</th>
            </tr>
            </thead>
            <tbody>

            @foreach($awardUsers as $awardUser)
                <tr>
                    <td>{{$awardUser->Award->id}}</td>
                    <td>{{$awardUser->Award->name}}</td>
                    <td><img src="{{url($awardUser->Award->image_path)}}" style="width:80px;"></td>
                    <td>{{$awardUser->User->name}}</td>
                    <td>{{$awardUser->updated_at}}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $awardUsers->render() !!}
    </div>

@endsection