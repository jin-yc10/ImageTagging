@extends('back.layouts.dashboard')
@section('page_heading','新建奖品')
@section('section')
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

    <div class="col-sm-12">

        <form action="{{url('back/award/store')}}" role="form" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label>奖品名称</label>
                <input name="name" class="form-control">
            </div>

            <div class="form-group">
                <label>奖品图片</label>
                <input name="image" type="file">
            </div>
            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>

@endsection