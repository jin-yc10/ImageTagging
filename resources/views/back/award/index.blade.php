@extends('back.layouts.master')
@section('title','数据标定平台｜奖品管理')
@section('awards','active')
@section('manage_award','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    奖品管理
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>名称</th>
                        <th><i class="icon-picture"></i>图片</th>
                        <th><i class=" icon-gears"></i>操作</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($awards as $award)
                        <tr>
                            <td>{{$award->id}}</td>
                            <td><a href="#">{{$award->name}}</a></td>
                            <td><img src="{{url($award->image_path)}}" style="width:80px;"></td>
                            <td>
                                <a href="{{url('admin/award/'.$award->id."/destroy")}}" onClick="return confirm('{{"确认要删除奖品".$award->name."么？"}}');" class="btn btn-danger btn-xs"><i class="icon-trash ">删除</i></a>
                                @if($award->isInLottery())
                                    <a href="{{url('admin/lottery/'.$award->Lottery->id."/destroy")}}" onClick="return confirm('{{"确认将奖品".$award->name."移除抽奖盘么？"}}');" class="btn btn-info btn-xs"><i class="icon-trash ">移除抽奖盘</i></a>
                                @else
                                    <button type="button" data-awardid="{{$award->id}}" data-awardname="{{$award->name}}" data-toggle="modal" data-target="#addtolottery"  role="button" class="btn btn-primary btn-xs"><i class="icon-plus-sign">加入抽奖盘</i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $awards->render() !!}
            </section>
        </div>
        <div class="modal fade" id="addtolottery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">中奖率设置</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/award/add2lottery')}}" role="form" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="award_id" id="award_id">
                            <div class="form-group">
                                <label for="name" class="control-label">奖品名称</label>
                                <input name="name" type="text" class="form-control" id="name">
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
                                <input type="reset" class="btn btn-default" data-dismiss="modal" value="取消">
                                <input type="submit" class="btn btn-primary"  value="加入转盘">
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
        $('#addtolottery').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var awardid = button.data('awardid') // Extract info from data-* attributes
            var awardname = button.data('awardname');
            $('#award_id').val(awardid);
            $('#name').val(awardname);
        })

    </script>
@endsection
