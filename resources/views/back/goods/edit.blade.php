@extends('back.layouts.master')
@section('title','数据标定平台｜修改兑换商品')
@section('goods','active')
@section('manage_goods','active')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('back/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    修改兑换商品
                </header>
                <div class="panel-body">
                    <form action="{{url('admin/goods/update')}}" role="form" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$goods->id}}">
                        <div class="form-group">
                            <label for="name">商品名称</label>
                            <input type="text" class="form-control" value="{{$goods->name}}" name="name" id="name" placeholder="输入商品名称">
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="points">商品图片</label>
                            </div>

                            <img src="{{asset($goods->image_path)}}" style="height:100px;width:auto;"/>
                        </div>
                        <div class="form-group">
                            <label for="number">商品数量</label>
                            <input type="text" class="form-control" value="{{$goods->number}}" name="number" id="number" placeholder="输入商品数量">
                        </div>
                        <div class="form-group">
                            <label for="points">兑换积分</label>
                            <input type="text" class="form-control" value="{{$goods->points}}" name="points" id="points" placeholder="输入兑换该商品所需要的积分">
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
    <script type="text/javascript" src="{{asset('back/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
@endsection