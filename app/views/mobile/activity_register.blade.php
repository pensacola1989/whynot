@section('styles')
<style type="text/css">
.ui-border-t i{ color:#7F8C8D;}
/*.ui-scroller{height:100px;}*/
</style>
@endsection
<div class="ui-slider">
    <ul class="ui-slider-content">
        <li><img src="http://i.gtimg.cn/aoi/sola/20141201154940_fXIQIADwLo.jpg"></li>
        <li><img src="http://i.gtimg.cn/aoi/sola/20141201154941_GhAN4FCMIF.jpg"></li>
        <li><img src="http://i.gtimg.cn/aoi/sola/20141201154939_LZJZBbo7ET.jpg"></li>
    </ul>
    <ul class="ui-slider-indicators">
        <li class="current">1</li>
        <li>2</li>
        <li>3</li>
    </ul>
</div>
<div class="ui-scroller">

<ul class="ui-list ui-list-text ui-list-cover ui-border-tb">
    <li class="ui-border-t">
        <p>
            <i class="fa fa-clock-o"></i>&nbsp;
            时间： 2014－12-23</p>
    </li>
    <li class="ui-border-t">
        <p>
            <i class="fa fa-crosshairs"></i>&nbsp;
            地点： 上海</p>
    </li>
    <li class="ui-border-t">
        <p>
            <i class="fa fa-users"></i>&nbsp;
            人数： 100</p>
    </li>
    <li class="ui-border-t">
         <div class="ui-list-info">
            <h4>
                <i class="fa fa-edit"></i>&nbsp;
                活动描述：这里描述活动内容这里描述活动内容这里描述活动内容这里描述活动内容里描述活动内容</h4>
        </div>
    </li>
</ul>
<p class="container">报名信息填写</p>
<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="ui-form-item ui-border-b">
            <label for="#">姓名</label>
            <input type="text" placeholder="姓名">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">手机</label>
            <input type="text" placeholder="手机">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">邮箱</label>
            <input type="text" placeholder="邮箱">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">兴趣</label>
            <input type="text" placeholder="兴趣">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-btn-wrap">
            <button class="ui-btn-lg ui-btn-primary">确定</button>
        </div>
    </form>
</div>

@section('scripts')
<script type="text/javascript">
!function($) {
    window.addEventListener('load', function() {
//        var myScroll = new Scroll('.ui-scroller', {
//            scrollY: true
//        });
    });
}(Zepto)
</script>
@endsection