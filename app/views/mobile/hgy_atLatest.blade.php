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
    <span style="font-size: 35px;">最新活动</span>
</h2>
</div>
@foreach($latestAts as $at)

<ul class="ui-list ui-border-tb">
    @if(count($at->Activities))
    <li>
        <span class="ui-txt-highlight org-span">{{ $at->userinfos ? $at->userinfos->u_username : '' }}</span>
    </li>
    @endif
    @if($at->Activities)
    @foreach($at->Activities as $a)
    <li>
        <div class="ui-avatar-s">
           <span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>
        </div>
        <div class="ui-list-info ui-border-t">
            <h4>{{ $a->title }}</h4>
            <p>
                {{ $a->content }}
                <span class="date-holder">
                    {{ $a->start_time }}
                </span>
            </p>
            @if($a->isRegister)
            <a class="ui-btn" href="{{ URL::action('mobile\ActivityController@atRegister', $a->id) }}">
                <i class="fa fa-eye"></i>&nbsp;查看
            </a>
            @else
            <a class="ui-btn" href="{{ URL::action('mobile\ActivityController@atRegister', $a->id) }}">
                <i class="fa fa-send"></i>&nbsp;报名
            </a>
            @endif
        </div>
    </li>
    @endforeach
    @endif
</ul>
@endforeach
{{--<ul class="ui-list ui-border-tb">--}}
    {{--<li>--}}
        {{--<span class="ui-txt-highlight org-span">基金会</span>--}}
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
                {{--<i class="fa fa-pencil"></i>&nbsp;报名--}}
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
                {{--<i class="fa fa-pencil"></i>&nbsp;报名--}}
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
{{--</ul>--}}