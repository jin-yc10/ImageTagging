@extends('back.layouts.master')
@section('title','数据标定平台｜数据集管理')
@section('dataset','active')
@section('create_dataset','active')
@section('content')

    <!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                创建数据集
            </header>
            <div class="panel-body">
                <form action="{{url('admin/dataset')}}" role="form" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="name">数据集名称</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="输入数据集名称">
                    </div>
                    <div class="form-group">
                        <label for="description">数据集描述</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="请输入对数据集的描述"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="standarditemfile">标准数据文件[可选]</label>
                        <input type="file" name="standarditemfile" id="standarditemfile">
                        <p class="help-block">提供数据集中的标准图片</p>
                    </div>
                    <div class="form-group">
                        <label for="itemfile">标注数据文件[可选]</label>
                        <input type="file" name="itemfile" id="itemfile">
                        <p class="help-block">数据集中待标定数据</p>
                    </div>

                    <button type="submit" class="btn btn-info">创建</button>
                    <button type="reset" class="btn btn-info">重置</button>
                </form>

            </div>
        </section>
    </div>
</div>
@endsection

@section('script')
@endsection