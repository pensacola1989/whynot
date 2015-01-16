@section('styles')
<style type="text/css">
.org-des p,i{color:#9d9d9d;}
</style>
@endsection
<h2 class="hgy-mobile-header">

    <div class="ui-avatar-one">
        <span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>
    </div>
    <span>{{ $currentOrg->u_username }}</span>

</h2>
<div class="org-des container">
    {{--<p>简介：致力于打造程序员交流的平台</p>--}}
<ul class="ui-list ui-list-text ui-border-tb">
    <li class="ui-border-t">
        <i class="fa fa-leaf">&nbsp;</i><p>已经成功开展活动数<div class="ui-badge-muted">{{ $activityCount }}</div></p>
    </li>
    <li class="ui-border-t">
        <i class="fa fa-user">&nbsp;</i><p>已有小伙伴数<div class="ui-badge-muted">{{ $vltCount }}</div></p>
    </li>
</ul>
<p>最新活动</p>
<ul class="ui-list ui-list-function ui-border-t">
@if(count($latestActivities) > 0)
@foreach($latestActivities as $at)
    <li>
        <div class="ui-avatar-s">
            <span style="background-image:url(http://icase.tencent.com/vlabs/img/?80*80)"></span>
        </div>
        <div class="ui-list-info ui-border-t">
            <h4>{{ $at->title }}</h4>
        </div>
        <a href="{{ URL::action('mobile\WcActivityController@atRegister', $at->id) }}" class="ui-btn">
            <i class="fa fa-eye"></i>&nbsp;&nbsp;查看
        </a>
    </li>
@endforeach
@endif
</ul>
</div>
