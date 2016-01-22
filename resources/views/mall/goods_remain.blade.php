<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <title>积分商城</title>

    <meta charset utf="8">
    <!--fonts-->
    <link href='http://fonts.useso.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>

    <!--fonts-->
    <!--bootstrap-->
    <link href="{{asset('/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!--coustom css-->
    <link href="{{asset('/dist/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <!--shop-kart-js-->
    <script type="text/javascript" src="{{asset('/dist/js/simpleCart.min.js')}}"></script>
    <!--default-js-->
    <script type="text/javascript" src="{{asset('/dist/js/jquery.min.js')}}"></script>
    <!--bootstrap-js-->
    <script type="text/javascript" src="{{asset('/dist/js/bootstrap.min.js')}}"></script>
    <!--script-->


    <style type="text/css">

        /*.col-md-4{*/
            /*margin-right: 10px;*/
            /*margin-left: 10px;*/
            /*margin-top: auto;*/
            /*margin-bottom: auto;*/
            /*padding: 15px;*/
            /*width:340px;*/
            /*height: 400px;*/



        /*}*/
        .ih-item{
            margin:auto;
            height:400px;
            width:340px;


        }
        .bottom-2-top {
            margin: auto;
            height:350px;
            width:100%;


        }

        .img .img-responsive{
            margin:auto;
            width:100%;
            height: auto;
            border:2px solid;
            border-radius:25px;

        }

        .info{
            margin:auto
            width:100%;
            height:auto;

        }



        .carousel-inner{

            margin:auto;
            width:350px;
            height:330px;

        }
        .item{
            margin-top: 100px;
            margin:auto;
            width:350px;
            height:350px;


        }
        .header-end .container{
            margin:auto;
            margin-top: 50px;
            width:80%;
            height:330px;
            border:2px solid;
            border-radius:25px;


        }
        .contact{
            text-align: center;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 30;
            border:2px solid;
            border-radius:25px;


        }
        h3{
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
            font-weight: 500;
            font-size: 20;
        }
        .foot{
            margin-top: 50px;
        }


        /*/!*right and left*!/*/
        /*.right*/
        /*{*/
            /*position:absolute;*/
            /*right:0px;*/
            /*top:0px;*/
            /*width:1%;*/
            /*height:1460px;*/
            /*background-color:#b0e0e6;*/
        /*}*/
        /*.left*/
        /*{*/
            /*position:absolute;*/
            /*left:0px;*/
            /*width:1%;*/
            /*top:0px;*/
            /*height: 1460px;*/
            /*background-color:#b0e0e6;*/
        /*}*/


    </style>


    {{--<script type="text/javascript" src="{{asset('/dist/js/jquery.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('/dist/js/jQueryRotate.2.2.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('/dist/js/jquery.easing.min.js')}}"></script>--}}

    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>

    <script type="text/javascript">

        $(function(){
            $("#buy").click(function(){
                var id=$("#buy").attr("name");
                buy(id);
            });
        });

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
//                    var u=json.user_id;


//                    $("#startbtn").unbind('click').css("cursor","default");
                    if(json.message=='1'){
                        alert('您的积分不够，请前往图片标注平台获取积分！');
//                        alert(u);

                    }
                    else{

                        alert('恭喜你，兑换成功\n');

                    }



                }
            });
        }
    </script>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="header-top">
            <div class="logo">
                <a href="{{url('/gl/goods')}}">积分商城</a>
            </div>
            <div class="login-bars">

                <a class="btn btn-default log-bar" href="{{url('/u/logout')}}" role="button">退出登录</a>

            </div>
            {{--<div class="clearfix"></div>--}}
        </div>

        {{--<div class="clearfix"></div>--}}
        </nav>
        <!--/.navbar-->
        {{--<div class="clearfix"></div>--}}
    </div>
    <!--/.content--->
</div>
<!--header-bottom-->
</div>
</div>
<div class="tianchong"> </div>

<div class="header-end">
    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{asset('/dist/image/goods/电脑.jpg')}}" alt="...">

                </div>
                <div class="item">
                    <img src="{{asset('/dist/image/goods/手机.png')}}" alt="...">

                </div>
                <div class="item">
                    <img src="{{asset('/dist/image/goods/饭票.jpg')}}" alt="...">

                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left car-icn" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right car-icn" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="shop-grid">
    <div class="container">
        @foreach($goods as $good)
            <div class="col-md-4 col-sm-12 grid-stn simpleCart_shelfItem">
                <!-- normal -->

                <div class="ih-item square effect3 bottom_to_top">
                    <div class="bottom-2-top">

                        <div class="img"><img src={{asset($good->image_path)}} alt="/" class="img-responsive gri-wid"></div>

                        <div class="info">
                            <div class="pull-left styl-hdn">
                                <h3>积分{{$good->points}}</h3>
                            </div>
                            <div class="pull-right styl-price">
                                <p><button onclick="buy({{$good->id}});" name={{$good->id}} class="item_add"><span class="glyphicon glyphicon-shopping-cart grid-cart" aria-hidden="true"></span> <span class=" item_price">兑换</span></button></p>
                            </div>
                            <div class="clearfix"></div>
                        </div></div>
                </div>
                <!-- end normal -->

            </div>
        @endforeach
    </div>

</div>




</body>

<script type="text/javascript">
    $(".img-responsive").addClass("carousel-inner img-responsive img-rounded");
    $(".item img").addClass("carousel-inner img-responsive img-rounded");

</script>
</html>