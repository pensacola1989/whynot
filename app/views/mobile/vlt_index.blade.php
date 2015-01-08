@section('styles')
<style type="text/css">
.ui-list li p{font-size: 15px;}
.grid-ul {
    margin-top:20px;
    background-color: #FFF;
    min-height: 100px;
    height: auto;
    display: inline-block;
    overflow: hidden;
    width: 100%;
}
.grid-li{
    border:1px dashed #eee;
    width: 49%;
    height: 150px;
    float: left;
}
.grid-li a{
    /*border: 1px dashed #E67E22;*/
    width: 100%;
    display: block;
    height: 100%;
    text-align: center;
}
.icon{
    font-size: 50px;
    line-height: 75px;
}
.grid-li a span{display: block;}
.item-num{color: #E74C3C;font-size: 20px;}
.item-des{color:#9d9d9d;}
</style>
@endsection
{{--<h2 class="hgy-mobile-header">--}}
    {{--<div class="ui-avatar-one">--}}
        {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>--}}
    {{--</div>--}}
    {{--<span>{{ $userData->username }}</span>--}}

{{--</h2>--}}
<h2 class="hgy-mobile-header">
    <img src="{{ URL::asset('images/home/hagongyi-3.png') }}" style="height:45px;" alt=""/>
    {{--<span style="font-size: 35px;">登录哈公益</span>--}}
</h2>
  <a href="{{ URL::action('mobile\VolunteerController@infoModify') }}" style="display: block;">
<ul class="ui-list ui-list-text ui-border-tb">
    <li class="ui-border-t ui-list-item-link">

            <p><i class="fa fa-pencil"></i>&nbsp;&nbsp;修改个人信息</p>

    </li>
</ul>
</a>
<ul class="ui-list ui-list-text ui-list-cover ui-border-tb">
    <li class="ui-border-t">
        <p>
            <i class="fa fa-mobile"></i>&nbsp;&nbsp;
            {{ $userData->mobile }}
        </p>
    </li>
    <li class="ui-border-t">
        <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;
        <p>{{ $userData->email }}</p>
    </li>
    <li class="ui-border-t">
        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;
        <p>兴趣：football</p>
    </li>
</ul>
<ul class="grid-ul">
    <li class="grid-li">
        <a href="#">
            <i style="color:#2ECC71;" class="fa fa-leaf icon"></i>
            <span class="item-num">{{ $activityCount }}</span>
            <span class="item-des">参加活动次数</span>
        </a>
    </li>
    <li class="grid-li">
        <a href="#">
            <i style="color:#16A085;" class="fa fa-comment icon"></i>
            <span class="item-num">{{ $commentCount }}</span>
            <span class="item-des">评价次数</span>
        </a>
    </li>
    <li class="grid-li">
        <a href="#">
            <i style="color:#2980B9;" class="fa fa-clock-o icon"></i>
            <span class="item-num">{{ $totalTime }}</span>
            <span class="item-des">小时时间</span>
        </a>
    </li>
</ul>