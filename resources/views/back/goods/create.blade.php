@extends('back.layouts.master')
@section('title','数据标定平台｜积分商城管理')
@section('goods','active')
@section('create_goods','active')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('back/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
        <!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                添加兑换商品
            </header>
            <div class="panel-body">
                <form action="{{url('admin/goods/store')}}" role="form" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="name">商品名称</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="输入商品名称">
                    </div>
                    <div class="form-group">
                        <label for="number">商品数量</label>
                        <input type="text" class="form-control" name="number" id="number" placeholder="输入商品数量">
                    </div>
                    <div class="form-group">
                        <label for="points">兑换积分</label>
                        <input type="text" class="form-control" name="points" id="points" placeholder="输入兑换该商品所需要的积分">
                    </div>
                    <div class="form-group">
                        <label>商品图片</label>
                        <div >
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{asset('back/img/noimage.png')}}" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="icon-paper-clip"></i>选择图片</span>
                                                   <span class="fileupload-exists"><i class="icon-undo"></i>选择其它图片</span>
                                                   <input type="file" name="image" class="default" />
                                                   </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> 删除</a>
                                </div>
                            </div>
                            <span class="label label-danger">注意!</span>
                                             <span>
                                             上传图片只支持最新的Firefox, Chrome, Opera,
                                             Safari 和 Internet Explorer 10
                                             </span>
                        </div>
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
    <script type="text/javascript" src="{{asset('back/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
@endsection