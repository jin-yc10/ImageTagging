@extends('back.layouts.master')
@section('title','数据标定平台｜设置抽奖盘')
@section('awards','active')
@section('lottery','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    抽奖盘设置
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>奖品名称</th>
                        <th><i class="icon-picture"></i>奖品图片</th>
                        <th><i class=" icon-barcode"></i>奖品数量</th>
                        <th><i class=" icon-adjust"></i>中奖率</th>
                        <th><i class=" icon-gears"></i>操作</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lotteries as $lottery)
                        <tr>
                            <td>{{$lottery->id}}</td>
                            <td><a href="#">{{$lottery->Award->name}}</a></td>
                            <td><img src="{{url($lottery->Award->image_path)}}" style="width:80px;"></td>
                            <td>{{$lottery->number}}</td>
                            <td>{{$lottery->prob}}</td>
                            <td>
                                {{--<a href="{{url('admin/lottery/'.$lottery->id."/edit")}}" class="btn btn-info btn-xs"><i class="icon-pencil ">修改</i></a>--}}
                                <button type="button" data-lotteryid="{{$lottery->id}}" data-number="{{$lottery->number}}" data-prob="{{$lottery->prob}}" data-awardname="{{$lottery->Award->name}}" data-toggle="modal" data-target="#editlottery"  role="button" class="btn btn-primary btn-xs"><i class="icon-pencil">修改</i></button>
                                <a href="{{url('admin/lottery/'.$lottery->id."/destroy")}}" onClick="return confirm('{{"确认将奖品".$lottery->name."移除抽奖盘么？"}}');" class="btn btn-danger btn-xs"><i class="icon-trash ">移除抽奖盘</i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
        </div>
        <div class="modal fade" id="editlottery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">抽奖奖品修改</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/lottery/update')}}" role="form" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" class="control-label">奖品名称</label>
                                <input name="name" type="text" class="form-control" id="name" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="number" class="control-label">奖品数量</label>
                                <input name="number" type="text" class="form-control" id="number">
                            </div>
                            <div class="form-group">
                                <label for="prob" class="control-label">中奖率</label>
                                <input name="prob" type="text" class="form-control" id="prob">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"  value="修改">
                                <input type="reset" class="btn btn-default" data-dismiss="modal" value="取消">

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#editlottery').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var lotteryid = button.data('lotteryid') // Extract info from data-* attributes
            var awardname = button.data('awardname');
            var number = button.data('number');
            var prob = button.data('prob');
            $('#id').val(lotteryid);
            $('#name').val(awardname);
            $('#number').val(number);
            $('#prob').val(prob);
        })

    </script>
@endsection
