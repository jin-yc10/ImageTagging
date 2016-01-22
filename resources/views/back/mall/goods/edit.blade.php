@extends('back.layouts.dashboard')
@section('page_heading','修改兑换商品信息')
@section('section')
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

    <div class="col-sm-12">

        <form action="{{url('back/goods/update')}}" role="form" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$goods->id}}">
            <div class="form-group">
                <label>商品名称</label>
                <input name="name" class="form-control" value="{{$goods->name}}">
            </div>
            <div class="form-group">
                <label>商品数量</label>
                <input type="text" name="number" class="form-control" rows="3" value="{{$goods->number}}">
            </div>
            <div class="form-group">
                <label>兑换积分</label>
                <input type="text" name="points" class="form-control" rows="3" value="{{$goods->number}}">
            </div>
            <button type="submit" class="btn btn-default">修改</button>
        </form>
    </div>

@endsection
