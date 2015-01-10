@section('styles')
<style type="text/css">
.org-info{border-bottom: 1px solid #eee;margin-bottom: 10px;}
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
    background-color: #2ECC71;
    border-color: #2ECC71;
    color:#FFF;
}
.index-big-icon.vlt{
    background-color: #e98b39;
    border-color: #e98b39;
    color:#FFF;
}
.dot-line{border:1px dotted #eee;}
</style>
@endsection
<div class="container">
<div class="row org-info">
  <div class="col-xs-6 col-md-4">
    <img src="{{ URL::asset('images/home/ico3.png') }}" alt="..." class="img-rounded">
  </div>
  <div class="col-xs-6 col-md-8">
    <h3 class="hgy-header">李嘉诚基金会</h3>
    <br/>
    <p>我们已经开展了xx个活动，xx小时的支援时间</p>
  </div>
</div>
<div class="container marketing">

<!-- Three columns of text below the carousel -->
<div class="row">
  <div class="col-lg-4 row-item">
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
    <hr class="dot-line"/>
    <p>
        <em>需总结的活动：</em>
        <b style="color:#2ECC71;">{{ $needSummary->title ? $needSummary->title : '' }}</b>
        <a role="button" href="{{ action('AtSummaryController@editSummary', $needSummary->id) }}" class="btn btn-default">
            总结 »
        </a>
    </p>
    <p>
        <em>默认活动时间</em>
        <b style="color:#2ECC71;">6小时</b>
    </p>
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
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
  <div class="col-lg-4">
    <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
    <h2>Heading</h2>
    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
    <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
  </div><!-- /.col-lg-4 -->
</div><!-- /.row -->



</div>
</div>