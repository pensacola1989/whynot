@section('styles')
<style type="text/css">
body{background-color: #FFF;}
.org-span{font-size:20px;}
.container{background-color: #EFEFEF;}
</style>
@endsection
<div class="container">
<h2 class="hgy-mobile-header ui-border-b">
    <i class="fa fa-leaf"></i>&nbsp;&nbsp;
    <span style="font-size: 35px;">我的活动历史</span>
</h2>
</div>

<ul class="ui-list ui-border-tb">
@foreach($attendAtHistory as $user)
    <li>
        <span class="ui-txt-highlight org-span">{{ $user->userinfos->u_username }}</span>
    </li>
    @if(count($user->Activities))
    @foreach($user->Activities as $at)
    <li>
        <div class="ui-avatar-s">
           <span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>
        </div>
        <div class="ui-list-info ui-border-t">
            <h4>{{ $at->title }}</h4>
            <p>
                {{ $at->content }}
                <span class="date-holder">
                    {{ $at->start_time }}
                </span>
            </p>
            <a class="ui-btn" href="{{ URL::action('mobile\VolunteerController@commentDetail', $at->id) }}">
                <i class="fa fa-comment-o"></i>&nbsp;评价
            </a>
        </div>
    </li>
    @endforeach
    @endif
@endforeach
    {{--<li>--}}
        {{--<div class="ui-avatar-s">--}}
           {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>--}}
        {{--</div>--}}
        {{--<div class="ui-list-info ui-border-t">--}}
            {{--<h4>活动1</h4>--}}
            {{--<p>--}}
                {{--活动1描述--}}
                {{--<span class="date-holder">--}}
                    {{--2014-12-22--}}
                {{--</span>--}}
            {{--</p>--}}
            {{--<div class="ui-btn">--}}
                {{--<i class="fa fa-eye"></i>&nbsp;查看--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<span class="ui-txt-highlight org-span">爱心社</span>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<div class="ui-avatar-s">--}}
           {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>--}}
        {{--</div>--}}
        {{--<div class="ui-list-info ui-border-t">--}}
            {{--<h4>活动1</h4>--}}
            {{--<p>--}}
                {{--活动1描述--}}
                {{--<span class="date-holder">--}}
                    {{--2014-12-22--}}
                {{--</span>--}}
            {{--</p>--}}
            {{--<div class="ui-btn">--}}
                {{--<i class="fa fa-eye"></i>&nbsp;查看--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<div class="ui-avatar-s">--}}
           {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>--}}
        {{--</div>--}}
        {{--<div class="ui-list-info ui-border-t">--}}
            {{--<h4>活动1</h4>--}}
            {{--<p>--}}
                {{--活动1描述--}}
                {{--<span class="date-holder">--}}
                    {{--2014-12-22--}}
                {{--</span>--}}
            {{--</p>--}}
            {{--<div class="ui-btn">--}}
                {{--<i class="fa fa-eye"></i>&nbsp;查看--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}

    {{--<li>--}}
        {{--<div class="ui-avatar-s">--}}
           {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>--}}
        {{--</div>--}}
        {{--<div class="ui-list-info ui-border-t">--}}
            {{--<h4>活动1</h4>--}}
            {{--<p>--}}
                {{--活动1描述--}}
                {{--<span class="date-holder">--}}
                    {{--2014-12-22--}}
                {{--</span>--}}
            {{--</p>--}}
            {{--<div class="ui-btn">--}}
                {{--<i class="fa fa-eye"></i>&nbsp;查看--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<div class="ui-avatar-s">--}}
           {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>--}}
        {{--</div>--}}
        {{--<div class="ui-list-info ui-border-t">--}}
            {{--<h4>活动1</h4>--}}
            {{--<p>--}}
                {{--活动1描述--}}
                {{--<span class="date-holder">--}}
                    {{--2014-12-22--}}
                {{--</span>--}}
            {{--</p>--}}
            {{--<div class="ui-btn">--}}
                {{--<i class="fa fa-eye"></i>&nbsp;查看--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<div class="ui-avatar-s">--}}
            {{--<span  style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>--}}
        {{--</div>--}}
        {{--<div class="ui-list-info ui-border-t">--}}
            {{--<h4>活动2</h4>--}}
            {{--<p>--}}
                {{--活动2描述--}}
                {{--<span class="date-holder">--}}
                    {{--2014-12-22--}}
                {{--</span>--}}
            {{--</p>--}}
            {{--<div class="ui-btn">--}}
                {{--<i class="fa fa-eye"></i>&nbsp;查看--}}
            {{--</div>--}}
      {{--</div>--}}
    {{--</li>--}}
</ul>