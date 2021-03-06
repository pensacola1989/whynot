{{ HTML::style('/styles/activity.css') }}
@section('styles')
<style type="text/css">
.form-control-feedback{right:10px;}
</style>
@endsection
<div class="page-header">
    <h2>
        活动基本信息
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>修改</small>
    </h2>
</div>
<div class="container">
      {{ Form::open(array('action'    =>  ['ActivityController@postActivityEdit', $activity->id],'method'  =>  'post','class'=>'container form-horizontal','role'=>'form','files'=>'true')) }}

      <div class="form-group form-group-material-amber">
        {{ Form::label('title','活动名称',array('class'   =>  'col-sm-2 control-label')) }}
        <div class="col-sm-10">
        {{ Form::text('title', $activity ? $activity->title : '' ,array('class'=>'form-control',"id"=>"inputTitle", "placeholder"=>"活动名称")) }}
        </div>
      </div>
      <div class="form-group form-group-material-amber">
        {{ Form::label('img_upload','活动图标',array('class' => 'col-sm-2 control-label'))  }}
        <input type="hidden" name="finish_tip" value="default_tips"/>
        <input type="hidden" name="channels" value="1,2"/>
        <input type="hidden" name="can_edit" value="0"/>
        <input type="hidden" name="is_verify" value="0"/>
        <input type="hidden" name="attend_num" value="0"/>
        <input type="hidden" name="approve_num" value="0"/>
        <input type="hidden" name="request_num" value="0"/>
        <input type="hidden" name="status" value="0"/>
        <img class="col-sm-10" src="{{ $activity ? $activity->cover : '' }}" id="uploadImg" style="height: 50px;">
        <input type="hidden" name="cover" value="{{ $activity ? $activity->cover_id : '' }}"/>
        <div class="col-sm-10">
            <botton type="botton" id="btnImg" class="btn btn-info">
                <i class="fa fa-upload"></i>
            </botton>
        </div>
      </div>
        <div class="form-group form-group-material-amber">
            {{ Form::label('start_time','开始时间',array('class'   =>  'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('start_time',$activity ? $activity->start_time : '',array('class'=>'form-control datetimepicker','readonly'=>'readonly',"id"=>"inputStartTime", "placeholder"=>"开始时间")) }}
            <span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group form-group-material-amber">
            {{ Form::label('end_time','结束时间',array('class'   =>  'col-sm-2 control-label ')) }}
            <div class="col-sm-10">
            {{ Form::text('end_time',$activity ? $activity->end_time : '',array('class'=>'form-control datetimepicker','readonly'=>'readonly',"id"=>"inputEndTime", "placeholder"=>"结束时间")) }}
            <span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>
        </div>
        </div>
        <div class="form-group form-group-material-amber" style="display: none;">
            {{ Form::label('area','活动地点',array('class'   =>  'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('area',$activity ? $activity->pureAreaJson : '',array('class'=>'form-control',"id"=>"inputArea", "placeholder"=>"活动地点")) }}
        </div>
        </div>
        <div class="form-group form-group-material-amber">
             {{ Form::label('content','活动内容',array('class'   =>  'col-sm-2 control-label')) }}
             <div class="col-sm-10">
             {{ Form::textarea('content',$activity ? $activity->content : '',array('class'=>'form-control',"id"=>"inputContent", "placeholder"=>"活动内容")) }}
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

        <div class="form-group">
            {{ Form::label('','',array('class'   =>  'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            <button type="submit" class="btn btn-success" onclick="javascript:void(null);">
            <i class="hgy-icon fa fa-check"></i>  保存  </button>
            <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
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

var locationJSON = '{{ $activity ? $activity->pureAreaJson : '' }}';

function uploadEnd(url,id){
    $('input[name=cover]').val(id);
    $('#uploadImg').attr('src',url);
}
function initLocationSelect() {
    var obj = {};

    if(locationJSON == '') {
        return false;
    }
    try {
        obj = JSON.parse(locationJSON);
    }
    catch (e) {
        console.log(e);
    }

    console.log(obj);
    setup();
    $('#s1').val(obj['country']);
    $('#s1').change();
    $('#s2').val(obj['province']);
    $('#s2').change();
    $('#s3').val(obj['distinct']);
}

$(function() {
    $('.datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd hh:ii'
    });

    $('button[type=submit]').on('click', function(e) {
        e.preventDefault();
        $(this).attr('disabled', true).html('正在提交...');
        $('form').submit();
        return false;
    });
    uploadImg();
    initLocationSelect();
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
});

</script>
@stop
