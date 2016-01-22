@extends('back.layouts.dashboard')
@section('page_heading','管理数据集')
@section('section')

    <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datasets as $dataset)
                <tr>
                        <td>{{$dataset->id}}</td>
                        <td>{{$dataset->name}}</td>
                        <td>{{substr($dataset->description,0,40).'...'}}</td>
                        <td>
                            <a href="{{url('back/dataset/'.$dataset->id."/edit")}}" role="button" class="btn btn-primary btn-outline">修改</a>
                            <a href="{{url('back/dataset/'.$dataset->id."/destroy")}}" onClick="return confirm('{{"确认要删除数据集".$dataset->name."么？"}}');" role="button" class="btn btn-primary btn-outline">删除</a>
                            <a href="{{url('back/dataset/'.$dataset->id.'/import/standarditem')}}" role="button" class="btn btn-primary btn-outline">导入标准数据</a>
                            <a href="{{url('back/dataset/'.$dataset->id.'/import/item')}}" role="button" class="btn btn-primary btn-outline">导入标定数据</a>

                        </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            {!! $datasets->render() !!}
    </div>

@endsection