@section('styles')
<style type="text/css">
.ui-border-t i{ color:#7F8C8D;}
.ui-scroller{min-height:400px;height:auto;overflow: hidden;padding-bottom: 100px;}
/*.ui-form{background-color:#FFF;min-height: 100px;height:auto;overflow: hidden;}*/
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
            时间： {{ $activity->start_time }}</p>
    </li>
    <li class="ui-border-t">
        <p>
            <i class="fa fa-crosshairs"></i>&nbsp;
            地点： {{ $activity->area }}</p>
    </li>
    <li class="ui-border-t">
        <p>
            <i class="fa fa-users"></i>&nbsp;
            人数： {{ $activity->request_num }}</p>
    </li>
    <li class="ui-border-t">
         <div class="ui-list-info">
            <h4>
                <i class="fa fa-edit"></i>&nbsp;
                活动描述：{{ $activity->content }}</h4>
        </div>
    </li>
</ul>
<p class="container">报名信息填写</p>
<div class="ui-form ui-border-t">
    <form action="#" >
    @if(count($attributes))
    @foreach($attributes as $attr)
    @if($attr->attr_type == 'text')
    <div class="ui-form-item ui-border-b">
        <label for="#">{{ $attr->attr_name }}</label>
        <input type="text" placeholder="{{ $attr->attr_name }}">
        <a href="#" class="ui-icon-close"></a>
    </div>
    @elseif($attr->attr_type == 'enum')
    <div class="ui-form-item">
        <label for="#">{{ $attr->attr_name }}</label>
        <br/>
    {{ $attr->parseEnum }}
    </div>
    @endif
    @endforeach
    @endif
        {{--<div class="ui-form-item ui-border-b">--}}
            {{--<label for="#">姓名</label>--}}
            {{--<input type="text" placeholder="姓名">--}}
            {{--<a href="#" class="ui-icon-close"></a>--}}
        {{--</div>--}}
        {{--<div class="ui-form-item ui-border-b">--}}
            {{--<label for="#">手机</label>--}}
            {{--<input type="text" placeholder="手机">--}}
            {{--<a href="#" class="ui-icon-close"></a>--}}
        {{--</div>--}}
        {{--<div class="ui-form-item ui-border-b">--}}
            {{--<label for="#">邮箱</label>--}}
            {{--<input type="text" placeholder="邮箱">--}}
            {{--<a href="#" class="ui-icon-close"></a>--}}
        {{--</div>--}}
        {{--<div class="ui-form-item ui-border-b">--}}
            {{--<label for="#">兴趣</label>--}}
            {{--<input type="text" placeholder="兴趣">--}}
            {{--<a href="#" class="ui-icon-close"></a>--}}
        {{--</div>--}}
        {{--<div class="ui-btn-wrap">--}}
            {{--<button class="ui-btn-lg ui-btn-primary">确定</button>--}}
        {{--</div>--}}
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