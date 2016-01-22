@extends('back.layouts.master')
@section('title','数据标定平台｜已领取奖品信息')
@section('awards','active')
@section('received_award','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    已领取奖品
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>奖品名称</th>
                        <th><i class="icon-picture"></i>奖品图片</th>
                        <th><i class="icon-user"></i>领奖人</th>
                        <th><i class=" icon-time"></i>领取时间</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($awardUsers as $awardUser)
                        <tr>
                            <td>{{$awardUser->Award->id}}</td>
                            <td><a href="#">{{$awardUser->Award->name}}</a></td>
                            <td><img src="{{url($awardUser->Award->image_path)}}" style="width:80px;"></td>
                            <td>{{$awardUser->User->name}}</td>
                            <td>{{$awardUser->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $awardUsers->render() !!}
            </section>
        </div>
    </div>
@endsection

@section('script')
@endsection
