@extends('back.layouts.master')
@section('title','数据标定平台｜数据集管理')
@section('dataset','active')
@section('manage_dataset','active')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                数据集管理
            </header>
            <table class="table table-striped table-advance table-hover">
                <thead>
                <tr>
                    <th><i class="icon-bookmark"></i>ID</th>
                    <th><i class="icon-info-sign"></i>名称</th>
                    <th><i class="icon-comment"></i>描述</th>
                    <th><i class=" icon-gears"></i>操作</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($datasets as $dataset)
                    <tr>
                        <td>{{$dataset->id}}</td>
                        <td><a href="#">{{$dataset->name}}</a></td>
                        <td>{{substr($dataset->description,0,40).'...'}}</td>
                        <td>

                            <a href="{{url('admin/dataset/'.$dataset->id."/edit")}}" class="btn btn-primary btn-xs"><i class="icon-pencil ">编辑</i></a>
                            <a href="{{url('admin/dataset/'.$dataset->id."/destroy")}}" onClick="return confirm('{{"确认要删除数据集".$dataset->name."么？"}}');" class="btn btn-danger btn-xs"><i class="icon-trash ">删除</i></a>
                            <a href="{{url('admin/dataset/'.$dataset->id."/import/standarditem")}}" class="btn btn-success btn-xs"><i class="icon-upload-alt ">导入标准数据</i></a>
                            <a href="{{url('admin/dataset/'.$dataset->id."/import/item")}}" class="btn btn-info btn-xs"><i class="icon-upload-alt ">导入标定数据</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $datasets->render() !!}
        </section>
    </div>
</div>
@endsection

@section('script')
@endsection
