<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>幸运大转盘  - PHP+AJAX实现</title>
    <style type="text/css">


        /*choujiang css*/
        .demo { height: 417px; margin: auto; position: relative; width: 417px;}
        #disk { background: url("{{asset('/dist/image/disk.jpg')}}") no-repeat; height: 417px; width: 417px;}
        #start { height: 320px; left: 130px; position: absolute; top: 46px; width: 163px;}


        /*scroll css*/
        *{margin:0;padding:0;font-size:12px;}
        body{background:none;}
        input,button,select,textarea{outline:none;}
        ul,li,dl,ol{list-style:none;}
        a{color:#666;text-decoration:none;}

        .bcon{width:270px;border:1px solid #eee;margin:30px auto;}
        .bcon h2{border-bottom:1px solid #eee;padding:0 10px;}
        .bcon h2 b{font:bold 14px/40px '宋体';border-top:2px solid #3492D1;padding:0 8px;margin-top:-1px;display:inline-block;}
        .list_lh{height:400px;overflow:hidden;}
        .list_lh li{padding:10px;}
        .list_lh li.lieven{background:#F0F2F3;}
        .list_lh li p{height:24px;line-height:24px;}
        .list_lh li p a{float:left;}
        .list_lh li p em{width:80px;font:normal 12px/24px Arial;color:#FF3300;float:right;display:inline-block;}
        .list_lh li p span{color:#999;float:right;}
        .list_lh li p a.btn_lh{background:#28BD19;height:17px;line-height:17px;color:#fff;padding:0 5px;margin-top:4px;display:inline-block;float:right;}
        .btn_lh:hover{color:#fff;text-decoration:none;}

        /*contact css*/
        .contact{
            text-align: center;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 30;
            border:2px solid;
            border-radius:25px;


        }

        /*right and left*/
        .right
        {
            position:absolute;
            right:0px;
            top:0px;
            width:20%;
            height:960px;
            background-color:#b0e0e6;
        }
        .left
        {
            position:absolute;
            left:0px;
            top:0px;
            width:20%;
            height: 960px;
            background-color:#b0e0e6;
        }




    </style>


    <script type="text/javascript" src="{{asset('/dist/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/dist/js/jQueryRotate.2.2.js')}}"></script>
    <script type="text/javascript" src="{{asset('/dist/js/jquery.easing.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/dist/js/scroll.js')}}"></script>



    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>

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
                        alert('您的积分不够，请前往图片标注平台获取积分！');
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
                                var con = confirm('恭喜你，中得'+p+'\n还要再来一次吗？');
                                if(con){
                                    lottery();
                                }else{
                                    //再次绑定click事件
//                                $("#startbtn").css("cursor","pointer").live("click",function(){
//                                    lottery();
//                                });
                                    return false;
                                }
                            }
                        });

                    }



                }
            });
        }
    </script>
</head>
<body>

<div class="left">


</div>




<div class="demo">
    <div id="disk"></div>
    <div id="start"><img id="startbtn" src="{{asset('/dist/image/start.png')}}" style="cursor: pointer; transform: rotate(0deg);"></div>
</div>

<div class="right">

</div>

<div class="bcon">
    <h2><b>幸运者是谁</b></h2>
    <!-- 代码开始 -->
    <div class="list_lh">
        <ul>
            @foreach($result as $oneresult)
                <li>
                    <p>{{$oneresult->username}}<em>幸运抽中</em></p>
                    <p>{{$oneresult->awardname}}<span>{{$oneresult->time}}</span></p>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- 代码结束 -->
</div>


<div class="foot"> </div>


<div class="footer-grid">
    <div class="contact"> Life is like a box of chocolate </div>

</div>

</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('.list_lh li:even').addClass('lieven');

        $("div.list_lh").myScroll({
            speed:40, //数值越大，速度越慢
            rowHeight:68 //li的高度
        });
    })
</script>
</html>