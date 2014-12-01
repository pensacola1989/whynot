{{ HTML::style('/styles/activity.css') }}
{{ HTML::style('/scripts/uploadify/uploadify.css') }}
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

        {{ Form::label('img_upload','活动图标',array('class' => 'col-sm-2 control-label'))  }}
        <div class="col-sm-10" id="uploadImg" style="height: 50px;width: 100px"></div>
        <div class="col-sm-10">
            {{ Form::file('img_upload','',array('class'=>'form-control','id'=>'img_upload')) }}
        </div>
      </div>
        <div class="form-group">
            {{ Form::label('start_time','开始时间',array('class'   =>  'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('start_time','',array('class'=>'form-control datetimepicker','readonly'=>'readonly',"id"=>"inputStartTime", "placeholder"=>"开始时间")) }}
            </div>
        </div>
        <div class="form-group">
                    {{ Form::label('end_time','结束时间',array('class'   =>  'col-sm-2 control-label ')) }}
                    <div class="col-sm-10">
                    {{ Form::text('end_time','',array('class'=>'form-control datetimepicker','readonly'=>'readonly',"id"=>"inputEndTime", "placeholder"=>"结束时间")) }}
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
        {{ Form::open(array('action'    =>  array('ActivityController@publish',2,$uid),'method'  =>  'post','class'=>'container form-horizontal attr_form','role'=>'form')) }}
                <input type="hidden" name="step" value="2"/>
                <div class="form-group">
                    {{ Form::label('u_name','姓名',array('class' => 'col-sm-2 control-label')) }}
                  <div class="col-sm-10">
                    {{ Form::text('u_name','',array('class'=>'form-control form_attr',"id"=>"u_name", "placeholder"=>"姓名",'attr_name'=>'attr_name','attr_title'=>'姓名','attr_type'=>'string','is_must'=>'checked')) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true')}}
                    <label >必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="下移"></button>
                  </div>
                </div>
                <div class="form-group">
                    {{ Form::label('u_phone','手机',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('u_phone','',array('class'=>'form-control form_attr',"id"=>"u_phone", "placeholder"=>"手机",'attr_name'=>'attr_phone','attr_title'=>'手机','attr_type'=>'string','is_must'=>'checked')) }}
                  </div>
                  <div class="attr_move">
                    {{ Form::checkbox('name', 'value','true') }}
                    <label>必填</label>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="上移"></button>
                    <button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="下移"></button>
                  </div>
                </div>
                <div class="form-group" id="form_after_attr">
                    {{ Form::label('u_email','邮箱',array('class'    =>  'col-sm-2 control-label'))  }}
                  <div class="col-sm-10">
                    {{ Form::text('u_email','',array('class'=>'form-control form_attr',"id"=>"u_email", "placeholder"=>"邮箱",'attr_name'=>'attr_email','attr_title'=>'邮箱','attr_type'=>'email','is_must'=>'checked')) }}
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
                <a href="#" class="btn btn-primary" id="formSend">
                <i class="hgy-icon glyphicon glyphicon-send"></i>  发布  </a>
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
                <label class="col-sm-2 control-label">字段名</label>
                <div class="col-sm-10">
                   <input type="text" id="m_attr_name" class="form-control" placeholder="字段名" >
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-2 control-label">字段标题</label>
                <div class="col-sm-10">
                   <input type="text" id="m_attr_title" class="form-control" placeholder="字段标题" >
                </div>
            </div>
            {{--<div class="clearfix"></div>--}}
            <div class="form-group clearfix">
                <label class="col-sm-2 control-label">字段类型</label>
                <div class="col-sm-10">
                   <select class="form-control" id="m_attr_type">
                     <option value="string">单行文本框</option>
                     <option value="number">数字</option>
                     <option value="time">日期</option>
                     <option value="email">邮箱</option>
                   </select>
                </div>
            </div>
            <div class="form-group clearfix">
                 <label class="col-sm-2 control-label">是否必填</label>
                 <div class="col-sm-10">
                     <select class="form-control" id="m_attr_istrue">
                       <option value="">否</option>
                       <option value="checked">是</option>
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
{{ HTML::script('/scripts/uploadify/jquery.uploadify.min.js') }}
<script type="text/javascript">

function add(){
    $("#attr_add").bind("click",function(){
        var name,title,type,istrue;
        name=$("#m_attr_name").val();
        title=$("#m_attr_title").val();
        type=$("#m_attr_type").val();
//        typename=$("#m_attr_type option:selected").val();
        istrue=$("#m_attr_istrue").val();
        attribute(name,title,type,istrue);
    });
}

function formSend(){
    $("#formSend").bind('click',function(){
        var obj = formToJsonObj(".form_attr");
        var jsonArr = '{"attrJson":'+JSON.stringify(obj)+'}';
//        var _data = eval(jsonArr);

        $.ajax({
                 type: "Post",
                 contentType: "application/json",
                 url: window.location.href,
                 data: jsonArr,
                 dataType: 'json',
                 success: function (result) {
                     alert("success");
                 }
            });
    });
}

$.fn.serializeObject = function()
{
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
}

function formToJsonObj(form){
    var attrArray = $(form);
    var obj=[];
    $.each(attrArray,function(i,val){
        var o = {
            "attr_name":$(val).attr("attr_name"),
            "attr_title":$(val).attr("attr_title"),
            "attr_type":$(val).attr("attr_type"),
            "is_must":$(val).attr("is_must")
        }
        obj.push(o);
    });
    return obj
}

function attribute(name,title,type,istrue){
    $("#form_after_attr").after(
        '<div class="form-group">'+
        '<label for="attr_name" class="col-sm-2 control-label">'+title+'</label>'+
        '<div class="col-sm-10">'+
        '<input class="form-control form_attr" id="attr_name" placeholder="'+title+'" type="text" attr_name="'+name+'" attr_title="'+title+'" attr_type="'+type+'" is_must="'+istrue+'">'+
        '</div>'+
        '<div class="attr_move">'+
        '<input '+istrue+' name="name" type="checkbox" value="value">'+
        '&nbsp;<label>必填</label>&nbsp;'+
        '<button type="button" class="btn btn-default glyphicon glyphicon-arrow-up" data-toggle="tooltip" data-placement="right" title="上移"></button>&nbsp;'+
        '<button type="button" class="btn btn-default glyphicon glyphicon-arrow-down" data-toggle="tooltip" data-placement="right" title="下移"></button>'+
        '</div>'+
        '</div>'
     );
}
function uploadImg(){
    $('#img_upload').uploadify({
        	'auto'     : true,//关闭自动上传
        	'removeTimeout' : 1,//文件队列上传完成1秒后删除
            'swf'      : '{{URL::asset('/scripts/uploadify/uploadify.swf')}}',
            'uploader' : window.location.href,
            'method'   : 'post',//方法，服务端可以用$_POST数组获取数据
    		'buttonText' : '选择图片',//设置按钮文本
            'multi'    : true, //允许同时上传多张图片
//            'uploadLimit' : 1,//一次最多只允许上传10张图片
            'fileTypeDesc' : 'Image Files',//只允许上传图像
            'fileTypeExts' : '*.gif; *.jpg; *.png',//限制允许上传的图片后缀
            'fileSizeLimit' : '20000KB',//限制上传的图片不得超过200KB
            'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
    			   alert(data);
            },
            'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数

            }
        });
}

$(function() {
    add();
    formSend();
    $('.datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd hh:ii'
    });
    uploadImg();
});

</script>
@stop
