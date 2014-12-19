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
{{ $content }}
<script src="http://i.gtimg.cn/vipstyle/frozenjs/lib/zepto.min.js?_bid=304"></script>
<script src="http://i.gtimg.cn/vipstyle/frozenjs/1.0.0/frozen.js?_bid=304"></script>
@yield('scripts')
</body>
</html>