<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="ISUX">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport" content="width=device-width,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="http://i.gtimg.cn/vipstyle/frozenui/1.2.0/css/frozen.css?_bid=306">
    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('/styles/mobile/main.css') }}
    @yield('styles')
</head>
<body>
<div class="">
@if($header)
<h2 class="hgy-mobile-header">

    <div class="ui-avatar-one">
        <span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>
    </div>
    <span>爱心社</span>

</h2>
@endif
</div>
{{ $content }}
{{ $footer }}
{{--<div class="ui-btn-group ui-btn-group-bottom">--}}
    {{--<button type="button">--}}
       {{--<i class="fa fa-bank"></i> 组织首页--}}
    {{--</button>--}}
    {{--<button type="button">--}}
        {{--<i class="fa fa-leaf"></i>--}}
        {{--活动--}}
    {{--</button>--}}
    {{--<button type="button">--}}
        {{--<i class="fa fa-user"></i>--}}
        {{--我的--}}
    {{--</button>--}}
{{--</div>--}}
<script src="http://i.gtimg.cn/vipstyle/frozenjs/lib/zepto.min.js?_bid=304"></script>
<script src="http://i.gtimg.cn/vipstyle/frozenjs/1.0.0/frozen.js?_bid=304"></script>
<script type="text/javascript">
!function($) {
    $('.nav-btn').on('tap', function() {
        window.location.href = $(this).attr('url');
    })
} (Zepto)
</script>
@yield('scripts')
</body>
</html>