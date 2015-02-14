@section('styles')
<style type="text/css">
.at_des {
border-bottom: 1px solid #efefef;
padding-bottom: 10px;
}
</style>
@endsection
<div class="page-header">
    <h2>
        活动总结
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>请填写活动相关得总结信息</small>
    </h2>
</div>
<div class="container">
<div class="row at_des">
  <div class="at_des_item col-md-3 text-primary">
     {{ $currentActivity->title }}
    <img class="at_img" src="" alt=""/>
  </div>
  <div class="at_des_item col-md-3">
    开始时间: <label class="label label-primary">{{ $currentActivity->start_time }}</label>
  </div>
  <div class="at_des_item col-md-3">
    人数: <label class="label label-primary">{{ $currentActivity->attend_num }}</label>
  </div>
  <div class="at_des_item col-md-3">
    地点: <label class="label label-primary">{{ $currentActivity->area }}</label>
  </div>
</div>
<div class="register_step row">
  <div class="col-md-4 step_item current">1.活动概况  <i class="glyphicon glyphicon-chevron-right"></i></div>
  <div class="col-md-4 step_item">2.参与人员评价<i class="glyphicon glyphicon-chevron-right"></i></div>
  <div class="col-md-4 step_item">3.渠道选择发布  <i class="glyphicon glyphicon-chevron-right"></i></div>
</div>
{{--@if($atComplete)--}}
 {{ Form::open(array('action'    =>  ['AtSummaryController@postEditSummary',$activityId],'method'  =>  'post','class'=>'container form-horizontal','role'=>'form','files'=>'true')) }}
        <input type="hidden" name="cpl_activity_reply" value="0"/>
      <div class="form-group">
        {{ Form::label('title','活动用时',array('class'   =>  'col-sm-2 control-label')) }}
        <div class="col-sm-10">
        {{ Form::text('cpl_activity_duration'
            ,$atComplete->cpl_activity_duration ? $atComplete->cpl_activity_duration : ''
            ,array('class'=>'form-control',"id"=>"inputTitle", "placeholder"=>"活动用时")) }}
         <p class="text-warning">本内容将影响志愿者的活动时间，请认真填写</p>
        </div>
      </div>
        <div class="form-group">
             {{ Form::label('content','活动概况',array('class'   =>  'col-sm-2 control-label')) }}

             <div class="col-sm-10">
             {{ Form::textarea('cpl_activity_des',
                $atComplete->cpl_activity_des ? $atComplete->cpl_activity_des : '',
                array('class'=>'form-control',"id"=>"inputContent", "placeholder"=>"活动概况")) }}
             </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-material-amber">
            <i class="hgy-icon fa fa-arrow-right"></i>  下一步  </button>
            <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
    {{ Form::close() }}
 {{--@endif--}}
</div>