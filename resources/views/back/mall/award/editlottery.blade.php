@extends('back.layouts.dashboard')
@section('page_heading','修改抽奖盘商品信息')
@section('section')
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

    <div class="col-sm-12">

        <form action="{{url('back/lottery/update')}}" role="form" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$lottery->id}}">
            <input type="hidden" name="award_id" value="{{$lottery->award_id}}">
            <div class="form-group">
                <label>奖品名称</label>
                <input name="award_name" class="form-control" value="{{$lottery->Award->name}}" readonly="readonly">
            </div>
            <div class="form-group">
                <label>奖品数量</label>
                <input type="text" name="number" class="form-control" rows="3" value="{{$lottery->number}}">
            </div>
            <div class="form-group">
                <label>中奖概率</label>
                <input type="text" name="prob" class="form-control" rows="3" value="{{$lottery->prob}}">
            </div>
            <button type="submit" class="btn btn-default">修改</button>
        </form>
    </div>

@endsection
