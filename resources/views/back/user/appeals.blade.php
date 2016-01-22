@extends('back.layouts.master')
@section('title','数据标定平台｜申诉管理')
@section('user','active')
@section('appeal_man','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    用户申诉管理
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-picture"></i>标准图片</th>
                        <th><i class="icon-picture"></i>标定图片</th>
                        <th><i class="icon-info"></i>用户标定结果</th>
                        <th><i class="icon-user "></i>申请人</th>
                        <th><i class="icon-gears"></i>操作</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wrongItems as $wrongItem)
                        <tr>
                            <td>{{$wrongItem->id}}</td>
                            <td><img src="{{asset($wrongItem->ItemUserRelation->Item->StandardItem->path)}}" style="width:80px;"></td>
                            <td><img src="{{asset($wrongItem->ItemUserRelation->Item->path)}}" style="width:80px;"></td>
                            <td>{{$wrongItem->ItemUserRelation->label == 1 ? '是' : '不是'}}</td>
                            <td>{{$wrongItem->ItemUserRelation->User->name}}</td>
                            <td>
                                <a href="{{url('admin/user/appeal/'.$wrongItem->id.'/pass')}}" class="btn btn-primary btn-xs"><i class="icon-pencil ">通过</i></a>
                                <a href="{{url('admin/user/appeal/'.$wrongItem->id.'/failed')}}" class="btn btn-warning btn-xs"><i class="icon-pencil ">不通过</i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $wrongItems->render() !!}
            </section>
        </div>
    </div>
@endsection

@section('script')
@endsection
