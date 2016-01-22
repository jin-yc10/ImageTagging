@extends('back.layouts.master')
@section('title','数据标定平台｜导入标准数据')
@section('dataset','active')
@section('manage_dataset','active')
@section('content')

        <!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                导入标准数据
            </header>
            <div class="panel-body">
                <form action="{{url('admin/dataset/import/standarditem')}}" role="form" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="dataset_id" value="{{$dataset->id}}">
                    <div class="form-group">
                        <label for="name">数据集名称</label>
                        <input type="text" class="form-control" name="name" id="name" readonly="readonly" value="{{$dataset->name}}">
                    </div>
                    <div class="form-group">
                        <label for="standarditemfile">标准数据文件</label>
                        <input type="file" name="standarditemfile" id="standarditemfile">
                        <p class="help-block">数据集中待标定数据</p>
                    </div>

                    <button type="submit" class="btn btn-info">导入</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('script')
@endsection