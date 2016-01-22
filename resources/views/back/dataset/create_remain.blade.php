@extends('back.layouts.dashboard')
@section('page_heading','创建数据集')
@section('section')
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

    <div class="col-sm-12">

        <form action="{{url('back/dataset')}}" role="form" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label>数据集名称</label>
                <input name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>数据集描述</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>标准数据文件</label>
                <input name="standarditemfile" type="file">
            </div>
            <div class="form-group">
                <label>标注数据文件</label>
                <input name="itemfile" type="file">
            </div>

            <button type="submit" class="btn btn-default">创建</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
    </div>

@endsection
