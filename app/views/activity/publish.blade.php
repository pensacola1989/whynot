{{ HTML::style('/styles/activity.css') }}
{{ HTML::style('/scripts/uploadify/uploadify.css') }}
{{ HTML::style('/scripts/datetimepicker/css/bootstrap-datetimepicker.min.css') }}
@section('styles')
<style type="text/css">
.form-control-feedback{right:10px;}
</style>
@endsection
<div class="container">
    <div class="register_step row">
      <div class="col-md-4 step_item {{ $step == 1 ? 'current' :'' }}">第一步：基本内容  <i class="fa fa-angle-double-right"></i></div>
      <div class="col-md-4 step_item {{ $step == 2 ? 'current' :'' }}">第二步：报名信息设计  <i class="fa fa-angle-double-right"></i></div>
      <div class="col-md-4 step_item {{ $step == 3 ? 'current' :'' }}">第三步：发布渠道选择  <i class="fa fa-angle-double-right"></i></div>
    </div>

      @if($step == 1)
      {{ Form::open(array('action'    =>  'ActivityController@publish','method'  =>  'post','class'=>'container form-horizontal','role'=>'form','files'=>'true')) }}
      {{--<input type="text" name="my_token" value="{{ $myToken }}"/>--}}
      <div class="form-group form-group-material-amber">
        {{ Form::label('title','活动名称',array('class'   =>  'col-sm-2 control-label')) }}
        <div class="col-sm-10">
        {{ Form::text('title','',array('class'=>'form-control',"id"=>"inputTitle", "placeholder"=>"活动名称")) }}
        </div>
      </div>
      <div class="form-group form-group-material-amber">
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
        <img class="col-sm-10" id="uploadImg" src="{{ URL::asset('images/at_cover.png') }}">
        <div class="col-sm-10">
{{--            {{ Form::file('img_upload','',array('class'=>'form-control','id'=>'img_upload')) }}--}}
            <botton type="botton" id="btnImg" class="btn btn-info">
                <i class="fa fa-upload"></i>
            </botton>
        </div>
      </div>
        <div class="form-group form-group-material-amber">
            {{ Form::label('start_time','开始时间',array('class'   =>  'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('start_time','',array('class'=>'form-control datetimepicker','readonly'=>'readonly',"id"=>"inputStartTime", "placeholder"=>"开始时间")) }}
            <span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>
            </div>

        </div>
        <div class="form-group form-group-material-amber">
        {{ Form::label('end_time','结束时间',array('class'   =>  'col-sm-2 control-label ')) }}
        <div class="col-sm-10">
        {{ Form::text('end_time','',array('class'=>'form-control datetimepicker','readonly'=>'readonly',"id"=>"inputEndTime", "placeholder"=>"结束时间")) }}
        <span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>
        </div>
        </div>
        <input type="hidden" name="area"/>
        {{--<div class="form-group form-group-material-amber">--}}
            {{--{{ Form::label('area','活动地点',array('class'   =>  'col-sm-2 control-label')) }}--}}
            {{--<div class="col-sm-10">--}}
            {{--{{ Form::text('area','',array('class'=>'form-control',"id"=>"inputArea", "placeholder"=>"活动地点")) }}--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group form-group-material-amber">
             {{ Form::label('content','活动内容',array('class'   =>  'col-sm-2 control-label')) }}
             <div class="col-sm-10">
             {{ Form::textarea('content','',array('class'=>'form-control',"id"=>"inputContent", "placeholder"=>"活动内容")) }}
             </div>
        </div>
        <div class="form-group form-group-material-amber">
             {{ Form::label('content','活动地点',array('class'   =>  'col-sm-2 control-label')) }}
             <div class="col-sm-10">
                <select id="s1" class="location-input form-control"> </select>
                <select id="s2" class="location-input form-control"> </select>
                <select id="s3" class="location-input form-control"> </select>

             </div>
        </div>
        <div class="form-group form-group-material-amber">
        {{ Form::label('','',array('class'   =>  'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            <button type="submit" onclick="javascript:return false;" class="btn btn-material-amber">
            <i class="hgy-icon fa fa-arrow-right"></i>  下一步  </button>
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


@section('scripts')
{{ HTML::script('/scripts/datetimepicker/js/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('/scripts/uploadify/jquery.uploadify.min.js') }}
{{ HTML::script('/scripts/province.js') }}
<script type="text/javascript">


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
        if(info){
            var obj = $.parseJSON(info.response);
            uploadEnd(obj.url,obj.id);
        }else{
            alert("上传失败！");
        }
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
window.onload = setup();
$(function() {

    var START_TIME, END_TIME;


    $('#inputStartTime').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        startDate: new Date(),
        autoclose: true,
        pickDate: false
    }).on('changeDate', function(ev) {
        START_TIME = ev.date.valueOf();
    });
    $('#inputEndTime').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        startDate: new Date(),
        autoclose: true
    }).on('changeDate', function(ev) {
        END_TIME = ev.date.valueOf();
        if(END_TIME <= START_TIME) {
            alert('结束时间不能小于开始时间');
            $('#inputEndTime').focus();
        }
    })

    uploadImg();
    $('select').on('change', function(e) {
        var country = $('#s1').val();
        var province = $('#s2').val();
        var distinct = $('#s3').val();
        var locationObj = {
            country: country,
            province: province,
            distinct: distinct
        }
        $('input[name=area]').val(JSON.stringify(locationObj));
    });
    $('button[type=submit]').on('click', function(e) {
        if(START_TIME >= END_TIME) {
            alert('结束时间不能小于开始时间');
            $('#inputEndTime').focus();
            e.preventDefault();
            return false;
        }
        $(this).html('正在提交...').attr('disabled', true);
        location.replace(this.href);
        $('form').submit();
    });
});

</script>
@stop
