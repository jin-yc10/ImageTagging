@extends('layouts.master')
@section('title', '数据标注平台｜数据标注')
@section('lottery', 'active')
<style type="text/css">


    /*choujiang css*/
    /*.demo { height: 417px; margin: auto; position: absolute; width: 417px; left:50px; top:100px;}*/
    /*.demo{border: 10px solid}*/
    #disk { background: url("{{asset('/imgs/lottery/disk.jpg')}}") no-repeat; height: 417px; width: 417px;}
    #start { height: 320px; position:absolute; left: 140px;  top: 50px; width: 163px;}


    /*scroll css*/

    body{background:none;}
    input,button,select,textarea{outline:none;}
    ul,li,dl,ol{list-style:none;}
    a{color:#666;text-decoration:none;}


    .bcon{border: 3px solid #eee; margin: 15px;}
    .bcon h2{border-bottom:1px solid #eee;padding:0 10px;}
    .bcon h2 b{font:bold 14px/40px '宋体';border-top:2px solid #3492D1;padding:0 8px;margin-top:-1px;display:inline-block;}
    .list_lh{height:350px;overflow:hidden;}
    .list_lh li{padding:10px;}
    .list_lh li.lieven{background:#F0F2F3;}
    .list_lh li p{height:24px;line-height:24px;}
    .list_lh li p a{float:left;}
    .list_lh li p em{width:80px;font:normal 12px/24px Arial;color:#FF3300;float:right;display:inline-block;}
    .list_lh li p span{color:#999;float:right;}
    .list_lh li p a.btn_lh{background:#28BD19;height:17px;line-height:17px;color:#fff;padding:0 5px;margin-top:4px;display:inline-block;float:right;}
    .btn_lh:hover{color:#fff;text-decoration:none;}


    /*zhuyishixiang*/
    .sides{
        text-align: center;

    }

    /*lottery list*/
    .l1{
        text-align: center;
        font-size: 40px;
        font-family: "Arial Black", arial-black;
        color: #fc5959;
        margin:30px;


    }


    .panel {
        border: none;
        box-shadow: none;
    }
    .product-list .pro-img-box {
        position: relative;
    }
    .product-list img {
        width: 200px;
        height:200px;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
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
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="demo">
                <div id="disk"></div>
                <div id="start"><img id="startbtn" src="{{asset('/imgs/lottery/start.png')}}" style="cursor: pointer; transform: rotate(0deg);"></div>
            </div>
        </div>


        <div class="col-md-3 col-lg-3">
            <div class="bcon">
                <h2><b>幸运者是谁</b></h2>
                <!-- 代码开始 -->
                <div class="list_lh">
                    <ul>
                        @foreach($lottery_users as $lottery_user)
                            <li>
                                <p>{{$lottery_user->User->name}}<em>幸运抽中</em></p>
                                <p>{{$lottery_user->Award->name}}<span>{{$lottery_user->time}}</span></p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- 代码结束 -->
            </div>
        </div>


        <div class="col-md-3 col-lg-3">
            <div class="sides">
                <h2>注意事项</h2>
                <input id=alert type="hidden" data-toggle="modal" href="#myModal3"/>
                <input id=confirm type="hidden" data-toggle="modal" href="#myModal2"/>
            </div>
        </div>
    </div>


    <div class="row product-list">

        <div class="col-md-12 col-lg-12">
           <div class="l1">奖品列表</div>
        </div>
        @foreach($lotterys as $lottery)
            <div class="col-md-3 col-lg-3">
                <section class="panel">

                    <img src="{{asset($lottery->Award->image_path)}}" alt=""/>
                    <div class="panel-body text-left">
                        <p class="name">{{$lottery->Award->name}}</p>
                    </div>
                </section>
            </div>
        @endforeach

    </div>


    {{--Modal3--}}
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <div id="infoConform" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>

                </div>
            </div>
        </div>
    </div>






@endsection


@section('script')

    <script type="text/javascript" src="{{asset('/js/jQueryRotate.2.2.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery.easing.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/scroll.js')}}"></script>


    <script type="text/javascript">

        $(function(){
            $("#startbtn").click(function(){
                lottery();
            });
        });
        function lottery(){
            $.ajax({

                //url: 'index.php',
                url:'lottery',
                type: 'post',
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

//                    $("#startbtn").unbind('click').css("cursor","default");
                    if(json.message=='1'){
//                        alert('您的积分不够，请前往图片标注平台获取积分！');
                        $("#alert").click();
                    }
                    else{
                        var a = json.angle; //角度
                        var p = json.prize; //奖项
                        $("#startbtn").rotate({
                            duration:3000, //转动时间
                            angle: 0,
                            animateTo:1800+a, //转动角度
                            easing: $.easing.easeOutSine,
                            callback: function(){
                                $('#infoConform').html('恭喜你，中得'+p);
                                $("#confirm").click();
                                }

                        });

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


    <script type="text/javascript">
        $(document).ready(function(){
            $('.list_lh li:even').addClass('lieven');

            $("div.list_lh").myScroll({
                speed:40, //数值越大，速度越慢
                rowHeight:68 //li的高度
            });
        })
    </script>
@endsection