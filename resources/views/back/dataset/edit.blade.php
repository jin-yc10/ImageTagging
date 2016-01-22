@extends('back.layouts.master')
@section('title','数据标定平台｜修改数据集')
@section('dataset','active')
@section('manage_dataset','active')
@section('content')

        <!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                修改数据集
            </header>
            <div class="panel-body">
                <form action="{{url('admin/dataset/update')}}" role="form" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$dataset->id}}">
                    <div class="form-group">
                        <label for="name">数据集名称</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$dataset->name}}" placeholder="输入数据集名称">
                    </div>
                    <div class="form-group">
                        <label for="description">数据集描述</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="请输入对数据集的描述">{{$dataset->description}}</textarea>
                    </div>


                    <button type="submit" class="btn btn-info">修改</button>
                    <button type="reset" class="btn btn-info">重置</button>
                </form>

            </div>
        </section>
    </div>
</div>
@endsection

@section('script')
@endsection