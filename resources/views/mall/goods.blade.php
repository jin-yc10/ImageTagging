@extends('layouts.master')
@section('title', '数据标注平台｜数据标注')
@section('goods', 'active')
<style type="text/css">
    .panel {
        border: none;
        box-shadow: none;
    }
    .product-list .pro-img-box {
        position: relative;
    }
    .product-list img {
        width: 350px;
        height:350px;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
    }
    .adtocart {
        background: #fc5959;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        color: #fff;
        display: inline-block;
        text-align: center;
        border: 3px solid #fff;
        left: 45%;
        bottom: -10px;
        position: relative;
    }
    .adtocart i {
        color: #fff;
        font-size: 25px;
        line-height: 42px;
    }
    .pro-title {
        color: #5A5A5A;
        display: inline-block;
        margin-top: 20px;
        font-size: 16px;
    }
    .product-list .price {
        color: #fc5959;
        font-size: 15px;
    }
</style>





@section('content')
    <div class="row product-list">

        @foreach($goods as $good)
            <div class="col-md-4">
                <section class="panel">

                    <img src="{{asset($good->image_path)}}" alt=""/>

                            <button onclick="buy({{$good->id}});" value="兑换" class="adtocart"> <i class="icon-shopping-cart"></i> </button>

                    <div class="panel-body text-left">
                        <h4>
                            <a href="#" class="pro-title">
                                {{$good->name}}
                            </a>
                        </h4>
                        <p class="price">积分{{$good->points}}</p>
                        <p class="number">剩余数量{{$good->number}}</p>
                    </div>
                </section>
            </div>
        @endforeach
    </div>



    <input type="hidden" id="alert1" data-toggle="modal" href="#myModal1"/>
    <input type="hidden" id="alert2" data-toggle="modal" href="#myModal2"/>
    <input type="hidden" id="alert3" data-toggle="modal" href="#myModal3"/>

    {{--Modal1--}}
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">提示信息</h4>
                </div>
                <div class="modal-body">

                    您的积分不够，请前往图片标注获取积分！
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                </div>
            </div>
        </div>
    </div>
    {{--Modal2--}}
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">中奖信息确认</h4>
                </div>
                <div class="modal-body">
                    您兑换的商品库存不足或已下架
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>

                </div>
            </div>
        </div>
    </div>

    {{--Modal3--}}
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">兑换信息确认</h4>
                </div>
                <div class="modal-body">
                    恭喜你，兑换成功
                </div>
                <div class="modal-footer">
                    <button id="success" onclick="history.go(0)" data-dismiss="modal" class="btn btn-default" type="button">关闭</button>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">




        function buy(id){
            $.ajax({

                //url: 'index.php',
                url:'goods',
                type: 'post',
                data: {'id':id},
                dataType: 'json',
//                headers: {
//                    'X-CSRF-TOKEN': _Token
//                },

                cache: false,
                error: function(){
                    alert('出错了！');
                    return false;
                },
                success:function(json){

                    if(json.message=='1'){
                        $("#alert1").click();

                    }
                    else if(json.message=='2'){

                        $("#alert2").click();

                    }
                    else{
                        $("#alert3").click();


                    }



                }
            });
        }
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : "{!! csrf_token() !!}" }
        });
    </script>

@endsection