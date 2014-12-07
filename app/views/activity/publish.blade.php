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
        <input type="hidden" name="cover" id="cover_id" value="2"/>
        {{ Form::label('img_upload','活动图标',array('class' => 'col-sm-2 control-label'))  }}
        <input type="hidden" name="finish_tip" value="default_tips"/>
        <input type="hidden" name="channels" value="1,2"/>
        <input type="hidden" name="can_edit" value="0"/>
        <input type="hidden" name="is_verify" value="0"/>
        <input type="hidden" name="attend_num" value="0"/>
        <input type="hidden" name="approve_num" value="0"/>
        <input type="hidden" name="request_num" value="0"/>
        <input type="hidden" name="status" value="0"/>
        <img class="col-sm-10" id="uploadImg" style="height: 50px;">
        <div class="col-sm-10">
{{--            {{ Form::file('img_upload','',array('class'=>'form-control','id'=>'img_upload')) }}--}}
            <botton type="botton" id="btnImg" class="btn btn-info">上传</botton>
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
                <div class="form-group">
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

            <div class="form-group" id="form_after_attr">
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
    var uid = {{ $uid ? $uid : 0 }};
    $("#formSend").bind('click',function(){
        var obj = formToJsonObj(".form_attr");
        var jsonArr = { attrJson: JSON.stringify(obj), activityId: uid };
        $.ajax({
                 type: "POST",
                 url: window.location.href,
                 data: jsonArr,
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
            "attr_name":$(val).attr("attr_title"),
            "attr_field_name":$(val).attr("attr_name"),
            "attr_type":$(val).attr("attr_type"),
            "is_must":$(val).attr("is_must") == 'checked' ? 1 : 0,
            'attr_des': '默认描述'
        }
        obj.push(o);
    });
    return obj
}

function attribute(name,title,type,istrue){
    $("#form_after_attr").before(
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
     $('[data-toggle="tooltip"]').tooltip();
     attrMove();
}

function attrMove(){
     $(".glyphicon-arrow-up").off('click').on('click',function(){
        var attrPrev = $(this).parent().parent().prev().clone();
        $(this).parent().parent().prev().remove();
        var p = $(this).parent().parent();
        attrPrev.insertAfter(p);
        attrMove();
     });
     $(".glyphicon-arrow-down").off('click').on('click',function(){

     });

}

//==================upload img=====================
function uploadImg(){
    var _uploader = new plupload.Uploader({
				            runtimes: 'html5,html4,flash',
				            browse_button: 'btnImg',
				            max_file_size: '2000mb',
				            chunk_size: '512kb',
				            multi_selection: false,
				            // resize: { width: 125, height: 85, quality: 90 },
				            flash_swf_url: 'plupload.flash.swf',
				            filters: [{
				                extensions: 'jpg,png,gif'
				            }]
				        });

//						_uploader.bind('UploadProgress',function (up,files) {
//							$('#' + btnId).siblings('.percent').html(files.percent + '%');
//				        });

				        _uploader.bind('BeforeUpload',function (up,files) {
				        	up.settings.file_data_name = 'chunkfile';
				        	up.settings.url = "{{action('UploadController@uploadFile')}}";
				        });

				        _uploader.bind('FileUploaded',function (up,file,info) {
				            var obj = $.parseJSON(info.response);
				            uploadEnd(obj.url,obj.id);
				        	//$('#' + btnId).siblings('img').attr('src',info.response);

				        });

				        _uploader.bind('UploadComplete',function (up,file) {
				        });

						_uploader.bind('init',function () {
				        	console.log('init');
				        });


				        _uploader.init();

				        _uploader.bind('FilesAdded',function (up,files) {
				        	up.start();
				        });
	}
	function uploadEnd(url,id){
	    $('#cover_id').val(id);
	    $('#uploadImg').attr('src',url);
	}
//==================upload img=====================

$(function() {
    add();
    formSend();
    attrMove();
    $('.datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd hh:ii'
    });
    uploadImg();
});

</script>
@stop
