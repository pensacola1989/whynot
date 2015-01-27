@section('styles')
<style type="text/css">
.col-md-2 label{ color: #9d9d9d;}
</style>
@endsection
<div class="page-header">
    <h2>
        活动详情
    </h2>
</div>
<div class="container">
@if($activities)
    <div class="row">
      <div class="col-md-2">
        <label for="">活动图片：</label>
      </div>
      <div class="col-md-10">
        <img src="{{ $activities->cover }}" alt=""/>

      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">活动名称：</label>
      </div>
      <div class="col-md-10">{{ $activities->title }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">活动地点：</label>
      </div>
      <div class="col-md-10">{{ $activities->area }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">审核状态：</label>
      </div>
      <div class="col-md-10">{{ $activities->is_verify }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">活动内容：</label>
      </div>
      <div class="col-md-10">{{ $activities->content }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">开始时间：</label>
      </div>
      <div class="col-md-10">{{ $activities->start_time }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">结束时间：</label>
      </div>
      <div class="col-md-10">{{ $activities->end_time }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">报名人数：</label>
      </div>
      <div class="col-md-10">{{ $activities->request_num }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="">签到人数：</label>
      </div>
      <div class="col-md-10">{{ $activities->attend_num }}</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a href="{{ URL::action('ActivityController@getModifyActvityInfo', $activities->id) }}" class="btn btn-primary">
            <i class="fa fa-pencil"></i>
            &nbsp;
            修改
        </a>
      </div>
      <div class="col-md-10"></div>
    </div>
    @endif
</div>