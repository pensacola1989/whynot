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
    </style>    
</head>
<body>
<div class="container">
<input type="text" name="nickname"/>
<img src="{{ URL::asset('whynot/nick_name.jpg') }}"/>
</div>
<div class="container gif-container">
	<button id="begin_game">
		
	</button>
    {{-- <img src="{{ URL::asset('bates/gif/bates-2years-gif1.gif') }}"/> --}}
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