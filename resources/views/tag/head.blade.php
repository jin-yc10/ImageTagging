{{--
 Created by jin-yc10 on 15/10/26.
 --}}
<header class="header-frontend">
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"  style="margin-top: 20px;">图片标注</a>
            </div>
            <div class="navbar-collapse collapse ">
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown" style="margin-top: 15px">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            {{--<img alt="" src="img/avatar1_small.jpg">--}}
                            <span class="username">{{$user->name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class="icon-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                            <li><a href="#" id="logout"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
            </div>
        </div>
    </div>
</header>
<form id="logout_form" action="/u/logout" method="GET">
    {!! csrf_field() !!}
</form>
<script type="application/javascript">
    $('#logout').on('click', function(){
        $('#logout_form').submit();
    });
</script>