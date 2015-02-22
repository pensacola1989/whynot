<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="ISUX">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport" content="width=device-width,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <title></title>
    <style type="text/css">
    html,body,div{padding:0;margin:0;position: relative;}
    @font-face{
        font-family: myfont;
        src: url('/Bates/font/myfont.ttf');
    }
    .container img{width:100%;}
    .gif-container{
        width: 60%;
        margin: auto;
        text-align: center;
    }
    .container input{
    	position: absolute;
		bottom: 65px;
		height: 30px;
		left: 95px;
		border: none;
		background-color: transparent;
    }
    #begin_game{
    	border: none;
		height: 58px;
		width: 184px;
		background: url('/whynot/btn_begin.jpg') no-repeat;
    }
    marquee{
        height: 74px;
        margin: 20px 50px;
        width: 200px;
        background-color: #FFF;
        position: absolute;
        /*border: 1px solid;*/
        bottom: 19px;
        left: 30px;
    }
    ul{padding: 0;}
    ul li{
        font-family: 'myfont';
        margin: 0;
    }
    .progress-bar {
        width:80%;
        margin: auto;
    }
    .progress-bar span{
        font-family: 'myfont';

    }
    .bar-container{
        /*border: 3px solid;*/
        height: 20px;
        margin-top: 10px;
        position: relative;
        /*border-radius: 10px;*/
    }
    .bar-container .bar-progress{
        position: absolute;
        /* border: 1px solid green; */
        height: 100%;
        width: 20%;
        background: url('/whynot/bar_bg.jpg') no-repeat;
    }
    </style>    
</head>
<body>
<div class="top-container container">
<marquee id="affiche" align="left" behavior="scroll" direction="up"  hspace="50" vspace="20" loop="-1" scrollamount="10" scrolldelay="100">
@if(count($totalUsers))
<ul>
    @foreach($totalUsers as $user)
    <li>{{ mb_substr($user->user_name,0,8,'utf-8') }}正在努力让老王放血</li>
    @endforeach
</ul>
@endif
</marquee>
    <img src="{{ URL::asset('whynot/marquee.jpg') }}">
</div>
<div class="container" style="text-align:center;">
@if($percent == 25)
    <img style="width:80%;" src="{{ URL::asset('Bates/gif/bates-2years-gif11.gif') }}"/>
@elseif($percent == 75)
    <img style="width:80%;" src="{{ URL::asset('Bates/gif/bates-2years-gif5.gif') }}"/>
@elseif($percent == 50)
    <img style="width:80%;" src="{{ URL::asset('Bates/gif/bates-2years-gif9.gif') }}"/>
@else
    <img style="width:80%;" src="{{ URL::asset('Bates/gif/bates-2years-gif2.gif') }}"/>
@endif   
</div>
<div class="container" style="margin-top:10px;">
    <div class="progress-bar">
        <span>老王已放血{{ 100-$percent }}%</span>
        <div class="bar-container">
            <img src="{{ URL::asset('whynot/' . $percent . 'per.jpg') }}">
        </div>
    </div>    
</div>

<script src="http://i.gtimg.cn/vipstyle/frozenjs/lib/zepto.min.js?_bid=304"></script>
<script type="text/javascript">
!function($) {
    // $('.nav-btn').on('tap', function() {
    //     window.location.href = $(this).attr('url');
    // })
} (Zepto)
</script>
</body>
</html>