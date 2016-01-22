@extends('back.layouts.dashboard')
@section('page_heading','管理奖品')
@section('section')

    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>图片</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($awards as $award)
                <tr>
                    <td>{{$award->id}}</td>
                    <td>{{$award->name}}</td>
                    <td><img src="{{url($award->image_path)}}" style="width:80px;"></td>
                    <td>

                        <a href="{{url('back/award/'.$award->id."/destroy")}}" onClick="return confirm('{{"确认要删除奖品".$award->name."么？"}}');" role="button" class="btn btn-primary btn-outline">删除</a>
                        <button type="button" data-awardid="{{$award->id}}" data-awardname="{{$award->name}}" data-toggle="modal" data-target="#addtolottery"  role="button" class="btn btn-primary btn-outline">加入抽奖盘</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {!! $awards->render() !!}
    </div>
    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtolottery" data-whatever="@mdo">加入转盘</button>--}}

    <div class="modal fade" id="addtolottery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">中奖率设置</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('back/award/add2lottery')}}" role="form" method="post">
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