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
                <div class="form-group ">
                    {{ Form::label('attr_name','姓名：',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('attr_name','',array('class'=>'form-control',"id"=>"attr_name", "placeholder"=>"姓名")) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="下移"></button>
                  </div>
                </div>
                <div class="form-group ">
                    {{ Form::label('attr_phone','手机',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('attr_phone','',array('class'=>'form-control',"id"=>"attr_phone", "placeholder"=>"手机")) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="下移"></button>
                  </div>
                </div>
                <div class="form-group" id="form_after_attr">
                    {{ Form::label('attr_email','邮箱',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('attr_email','',array('class'=>'form-control',"id"=>"attr_email", "placeholder"=>"邮箱")) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="下移"></button>
                  </div>
                </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                 <div class="col-sm-10">
                     <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" >
                      <i class="hgy-icon glyphicon glyphicon-plus "></i>  添加  </a>
                 </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-primary">
                <i class="hgy-icon glyphicon glyphicon-send"></i>  发布  </button>
                <p style="color:red;">{{ $errors->first() }}</p>
                </div>
            </div>

 {{ Form::close() }}
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

<!-- 自定义字段 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">自定义字段</h4>
      </div>
      <div class="modal-body">
            <div class="form-group clearfix">
                <label class="col-sm-2 control-label">字段名称</label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="字段名称" >
                </div>
            </div>
            {{--<div class="clearfix"></div>--}}
            <div class="form-group clearfix">
                <label class="col-sm-2 control-label">字段类型</label>
                <div class="col-sm-10">
                   <select class="form-control">
                     <option >单行文本框</option>
                     <option>数字</option>
                     <option>日期</option>
                     <option>邮箱</option>
                   </select>
                </div>
            </div>
            <div class="form-group clearfix">
                 <label class="col-sm-2 control-label">是否必填</label>
                 <div class="col-sm-10">
                     <select class="form-control">
                       <option>否</option>
                       <option>是</option>
                     </select>
                 </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="attr_add">确定</button>
      </div>
    </div>
  </div>
</div>

@section('scripts')
{{ HTML::script('/scripts/datetimepicker/js/bootstrap-datetimepicker.min.js') }}
<script type="text/javascript">

function add(){
    $("#attr_add").bind("click",function(){
        var name,type,istrue;

        attribute(name,type,istrue);
    });
}

function attribute(name,type,istrue){
    $("#form_after_attr").after(
        '<div class="form-group">'+
        '   <label for="attr_name" class="col-sm-2 control-label"></label>'+
        '   <div class="col-sm-10">'+
        '       <input class="form-control" id="attr_name" placeholder="姓名" name="attr_name" type="text" value="">'+
        '   </div>'+
        '   <div class="attr_move">'+
        '       <input checked="checked" name="name" type="checkbox" value="value">'+
        '       <label>必填</label>'+
        '       <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="" data-original-title="上移"></button>'+
        '       <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="" data-original-title="下移"></button>'+
        '   </div>'+
        '</div>'
     );
}

$(function() {
    add();
});

</script>
@stop
