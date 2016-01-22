@extends('back.layouts.master')
@section('title','数据标定平台｜领取兑换商品')
@section('awards','active')
@section('receive_award','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    领取奖品
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>奖品名称</th>
                        <th><i class="icon-picture"></i>奖品图片</th>
                        <th><i class="icon-user"></i>中奖人</th>
                        <th><i class=" icon-gears"></i>操作</th>
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
                            <td>

                                <a href="{{url('admin/award/'.$awardUser->id."/gotten")}}" onClick="return confirm('{{"确认中奖人".$awardUser->User->name."领取奖品".$awardUser->Award->name."？"}}');" class="btn btn-primary btn-xs"><i class="icon-pencil ">领取</i></a>

                            </td>
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
