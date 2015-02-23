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
       height: 60px;
        margin: 20px 50px;
        width: 150px;
        background-color: #FFF;
        position: absolute;
        /* border: 1px solid; */
        bottom: 19px;
        left: 30px;
        font-size: .2em;
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
    .modal{
        position: fixed;
        background-color: rgba(0,0,0,0.7);
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        z-index: 100;
    }
    .modal-win{
        height: 200px;
        width: 300px;
        /* background: green; */
        left: 10%;
         position: relative; 
    }
    .modal-win img{
        width:100%;
        position: absolute;
    }
    .modal-win p{
        position: absolute;
        color: #FFF;
        font-family: 'myfont';
        width: 100%;
        text-align: center;
        font-size: 1.5em;
        margin-top: 48px;
    }
    #close{
        height: 50px;
        width: 50px;
        position: absolute;
        right: 0;
        z-index: 200;
    }
    </style>    
</head>
<body>
<div class="modal">
    <div class="modal-win">
        <a href="javascript:void(null);" id="close"></a>
        <img src="{{ URL::asset('whynot/popup.png') }}">
        <p>左摇摇，右摇摇
        <br/>拿起手机尽情摇摆
        <br/>合力将抠门老板摇晕，<br/>开年红包就是我们的啦<br/></p>
    </div>
</div>
<div class="top-container container">
<marquee id="mq" align="left" behavior="scroll" direction="up"  hspace="50" vspace="20" loop="-1" scrollamount="10" scrolldelay="100">
@if(count($totalUsers))
<ul id="mq_ul" style="display:none;">
    @foreach($totalUsers as $user)
    <li>{{ mb_substr($user->user_name,0,8,'utf-8') }}正在努力让老王放血</li>
    @endforeach
</ul>
@endif
</marquee>
    <img src="{{ URL::asset('whynot/marquee.jpg') }}">
</div>
<div class="container" style="text-align:center;">
    <img id="gif_default" style="width:80%;display:block;" src="{{ URL::asset('whynot/static_gif.png') }}"/>
    <div style="display:none;" id="gif_con">
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
<script type="text/javascript" src={{ URL::asset('scripts/shake.js') }}></script>
<script type="text/javascript">

var isShaking = false;

window.onload = function() {

    setInterval(function() {
        if(!isShaking) {
            $('#gif_default').css('display', 'block');
            $('#gif_con').css('display', 'none');
        }
    },2000);

    //create a new instance of shake.js.
    var myShakeEvent = new Shake({
        threshold: 10,
        timeout: 1000, 
        notThresholdCb: function() {
           isShaking = false;
        }
    });

    // start listening to device motion
    myShakeEvent.start();

    // register a shake event
    window.addEventListener('shake', shakeEventDidOccur, false);

    //shake event callback
    function shakeEventDidOccur () {
        $('#mq_ul').show();
        $('#gif_default').css('display', 'none');
        $('#gif_con').css('display', 'block');
        isShaking = true;
        //put your own code here etc.
        // alert('fuck');
        // document.getElementById('mq_ul').style.display = 'block';
        // document.getElementById('gif_default').style.display = 'none';
        // document.getElementById('gif_con').style.display = 'block';
        // myShakeEvent.stop();
    }

};



!function($) {
    $('a').on('click', function() {
        $('.modal').hide();
    });
} (Zepto)
</script>
</body>
</html>