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
     @font-face{
        font-family: myfont;
        src: url('/Bates/font/myfont.ttf');
    }
    html,body,div{padding:0;margin:0;position: relative;}
    .container img{width:100%;}
    .gif-container{
        width: 60%;
        margin: auto;
        text-align: center;
    }
    .container input{
    	position: absolute;
		bottom: 44px;
		height: 30px;
		left: 100px;
		border: none;
		background-color: transparent;
		width: 50%;
		border: 3px solid;
		border-radius: 20px;
		background: #EEE;
    }
    #begin_game{
    	border: none;
		height: 58px;
		width: 184px;
		background: url('/whynot/btn_begin.jpg') no-repeat;
    }
    input{
    	font-family: 'myfont';
    	font-weight: bold;
		font-size: 1em;
    }
    </style>    
</head>
<body>
<form action="{{ URL::action('whynot\ShakeController@postNickName') }}" method="post">
<div class="container">
<input type="text" name="nickname" id="nickname"/>
<img src="{{ URL::asset('whynot/nick_name2.jpg') }}"/>
</div>

<div class="container gif-container">
	<button id="begin_game">
		
	</button>
    {{-- <img src="{{ URL::asset('bates/gif/bates-2years-gif1.gif') }}"/> --}}
</div>
</form>

<script src="http://i.gtimg.cn/vipstyle/frozenjs/lib/zepto.min.js?_bid=304"></script>
<script type="text/javascript">
!function($) {
	var domWith = $(document).width();
	var inputWidth = $('#nickname').width();
	var css = {
		'left': (domWith - inputWidth) / 2
	}
    $('#nickname').css(css);
} (Zepto)
</script>
</body>
</html>