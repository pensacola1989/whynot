@section('styles')
<style type="text/css">
/*.org-info{border-bottom: 1px solid #eee;}*/
h3,p{color:#34495E;}
.index-big-icon {
    border: 1px solid;
    height: 140px;
    width: 140px;
    text-align: center;
    line-height: 140px;
    font-size: 5em;
    border-radius: 140px;
}
.index-big-icon.at{
    background-color: #FFF;
    border-color: #F5A614;
    color: #F5A614;
    border: 2px solid;
}
.index-big-icon.vlt{
    background-color: #FFF;
    border-color: #F5A614;
    color: #F5A614;
    border: 2px solid;
}
.dot-line{border:1px dotted #eee;}
.marketing {
    /*background-color: #F5A614;*/
}
.row-item{text-align: center;}
.row-item h3,.row-item p{
    color: #F5A614;
}
.org-info{border-top:2px solid #F5A614;}
.heart{
    position: absolute;
    border: 2px solid;
    height: 60px;
    width: 60px;
    font-size: 30px;
    line-height: 60px;
    text-align: center;
    border-radius: 30px;
    right: 150px;
    top: -30px;
    background-color: #FFF;
    border-color: #F5A614;
    color:#F5A614;
}
</style>
@endsection
<div class="container">

<div class="container marketing">

<!-- Three columns of text below the carousel -->
<div class="row">
  <div class="col-lg-6 row-item">
    <i class="index-big-icon at fa fa-leaf"></i>
    <h3>活动情况</h3>
    <p>
        <em>正在开展的活动：</em>
        <b style="color:#2ECC71;">{{ $currentActivity ? $currentActivity->title: '' }}</b>
    </p>
    <p>
        <em>报名数/审核数：</em>
        <b style="color:#2ECC71;">{{ $currentActivity ? $currentActivity->request_num : '' }}</b>
        /
        <b>{{ $currentActivity ? $currentActivity->approve_num : 0}}</b>
    </p>
    {{--<hr class="dot-line"/>--}}
    {{--<p>--}}
        {{--<em>需总结的活动：</em>--}}
        {{--@if($needSummary)--}}
        {{--<b style="color:#2ECC71;">{{ $needSummary->title }}</b>--}}
        {{--<a role="button" href="{{ action('AtSummaryController@editSummary', $needSummary->id) }}" class="btn btn-default">--}}
            {{--总结 »--}}
        {{--</a>--}}
        {{--@endif--}}
    {{--</p>--}}
    <p>
        <em>默认活动时间</em>
        <b style="color:#2ECC71;">6小时</b>
    </p>
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-6 row-item">
    <i class="index-big-icon vlt fa fa-child"></i>
    <h3>志愿者情况</h3>
     <p>
        <em>志愿者总数：</em>
        <a href="{{ action('VolunteerController@GetVolSearch') }}">{{ $vltCount }}</a>
    </p>
    <p>
        <em>志愿者分组：</em>
        @if($orgGroups)
        @foreach($orgGroups as $group)
       <a href="{{ action('VolunteerController@checkByGroup', $group->id) }}">{{ $group->group_name }}</a>,
        @endforeach
        @endif
    </p>
  </div><!-- /.col-lg-4 -->

</div><!-- /.row -->



</div>
<div class="row org-info" style="background-color: #FFF;padding-top:30px;position: relative;">
<div class="heart" style="position: absolute;">
<i class="fa fa-heart-o"></i>
</div>
  <div class="col-xs-6 col-md-4" style="text-align: right;">
    <img data-src="holder.js/140x140" class="img-circle" alt="140x140" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTBwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4xNDB4MTQwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 140px; height: 140px;">
  </div>
  <div class="col-xs-6 col-md-8">
    <h3 class="hgy-header">李嘉诚基金会</h3>
    <br/>
    <p>我们已经开展了xx个活动，xx小时的支援时间</p>
  </div>
</div>
</div>