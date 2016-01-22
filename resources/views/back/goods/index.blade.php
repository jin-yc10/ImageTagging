@extends('back.layouts.master')
@section('title','数据标定平台｜兑换商品管理')
@section('goods','active')
@section('manage_goods','active')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    兑换商品管理
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bookmark"></i>ID</th>
                        <th><i class="icon-info-sign"></i>名称</th>
                        <th><i class="icon-picture"></i>图片</th>
                        <th><i class="icon-yen"></i>兑换积分</th>
                        <th><i class="icon-barcode "></i>商品数量</th>
                        <th><i class=" icon-gears"></i>操作</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $good)
                        <tr>
                            <td>{{$good->id}}</td>
                            <td><a href="#">{{$good->name}}</a></td>
                            <td><img src="{{url($good->image_path)}}" style="width:80px;"></td>
                            <td>{{$good->points}}</td>
                            <td>{{$good->number}}</td>
                            <td>

                                <a href="{{url('admin/goods/'.$good->id."/edit")}}" class="btn btn-primary btn-xs"><i class="icon-pencil ">编辑</i></a>
                                @if($good->available)
                                    <a href="{{url('admin/goods/'.$good->id."/unavailable")}}" class="btn btn-info btn-xs"><i class="icon-pencil ">下架</i></a>
                                @else
                                    <a href="{{url('admin/goods/'.$good->id."/available")}}" class="btn btn-warning btn-xs"><i class="icon-pencil ">上架</i></a>
                                @endif
                                <a href="{{url('admin/goods/'.$good->id."/destroy")}}" onClick="return confirm('{{"确认要删除商品".$good->name."么？"}}');" class="btn btn-danger btn-xs"><i class="icon-trash ">删除</i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $goods->render() !!}
            </section>
        </div>
    </div>
@endsection

@section('script')
@endsection
