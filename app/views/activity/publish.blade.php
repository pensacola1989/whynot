{{ HTML::style('/styles/activity.css') }}
<div class="container">
    <div class="register_step row">
      <div class="col-md-4 step_item {{ $step == 1 ? 'current' :'' }}">第一步：基本内容  <i class="glyphicon glyphicon-chevron-right"></i></div>
      <div class="col-md-4 step_item {{ $step == 2 ? 'current' :'' }}">第二步：报名信息设计  <i class="glyphicon glyphicon-chevron-right"></i></div>
      <div class="col-md-4 step_item {{ $step == 3 ? 'current' :'' }}">第三步：发布渠道选择  <i class="glyphicon glyphicon-chevron-right"></i></div>
    </div>

      @if($step == 1)
      {{ Form::open(array('action'    =>  'ActivityController@publish','method'  =>  'post','class'=>'container form-horizontal','role'=>'form','files'=>'true')) }}

      <div class="form-group">
        {{ Form::label('title','活动名称',array('class'   =>  'col-sm-2 control-label')) }}
        <div class="col-sm-10">
        {{ Form::text('title','',array('class'=>'form-control',"id"=>"inputTitle", "placeholder"=>"活动名称")) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('cover_id','活动图标：',array('class'    =>  'col-sm-2 control-label'))  }}
        <div class="col-sm-10">
         {{ Form::file('cover_id','',array('class'=>'form-control',"id"=>"inputCoverId", "placeholder"=>"活动图标")) }}
        </div>
      </div>
        <div class="form-group">
            {{ Form::label('start_time','开始时间',array('class'   =>  'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('start_time','',array('class'=>'form-control',"id"=>"inputStartTime", "placeholder"=>"开始时间")) }}
            </div>
        </div>
        <div class="form-group">
                    {{ Form::label('end_time','结束时间',array('class'   =>  'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                    {{ Form::text('end_time','',array('class'=>'form-control',"id"=>"inputEndTime", "placeholder"=>"结束时间")) }}
                    </div>
        </div>
        <div class="form-group">
                            {{ Form::label('area','活动地点',array('class'   =>  'col-sm-2 control-label')) }}
                            <div class="col-sm-10">
                            {{ Form::text('area','',array('class'=>'form-control',"id"=>"inputArea", "placeholder"=>"活动地点")) }}
                            </div>
        </div>
        <div class="form-group">
             {{ Form::label('content','活动内容',array('class'   =>  'col-sm-2 control-label')) }}
             <div class="col-sm-10">
             {{ Form::textarea('content','',array('class'=>'form-control',"id"=>"inputContent", "placeholder"=>"活动内容")) }}
             </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
            <i class="hgy-icon glyphicon glyphicon-hand-right"></i>  下一步  </button>
            <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
    {{ Form::close() }}
        @elseif($step == 2)
        {{ Form::open(array('action'    =>  array('ActivityController@publish',2,$uid),'method'  =>  'post','class'=>'container form-horizontal','role'=>'form')) }}
                <input type="hidden" name="step" value="2"/>
                <div class="form-group">
                    {{ Form::label('attr_name','姓名：',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('attr_name','',array('class'=>'form-control',"id"=>"attr_name", "placeholder"=>"姓名")) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="left" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="left" title="下移"></button>
                  </div>
                </div>
                <div class="form-group">
                    {{ Form::label('attr_phone','手机',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('attr_phone','',array('class'=>'form-control',"id"=>"attr_phone", "placeholder"=>"手机")) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="left" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="left" title="下移"></button>
                  </div>
                </div>
                <div class="form-group">
                    {{ Form::label('attr_email','邮箱',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('attr_email','',array('class'=>'form-control',"id"=>"attr_email", "placeholder"=>"邮箱")) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="left" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="left" title="下移"></button>
                  </div>
                </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                 <div class="col-sm-10">
                     <a href="#" class="btn btn-success">
                      <i class="hgy-icon glyphicon glyphicon-plus"></i>  添加  </a>
                 </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-primary">
                <i class="hgy-icon glyphicon glyphicon-user"></i>  发布  </button>
                <p style="color:red;">{{ $errors->first() }}</p>
                </div>
            </div>

        @elseif(!$is_verify)

        <h3 style="padding-left: 100px;color:#2980B9;">
            <i class="glyphicon glyphicon-info-sign"></i> &nbsp;&nbsp;
            您的活动已经提交，请等待审核
        </h3>
        @else
        <h3 style="padding-left: 100px;color:#2980B9;">

        </h3>
        @endif

</div>
