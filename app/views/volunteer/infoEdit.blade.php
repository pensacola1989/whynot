<div class="page-header">
    <h2>
        {{ $viewType == 'add' ? '添加字段' : '编辑字段' }}
        <small></small>
    </h2>
</div>
@if($viewType == 'add')
{{ Form::open(array('action'    =>  array('VlrInfoController@postEdit'),'method'  =>  'post','class'=>'container form-horizontal','role'=>'form')) }}
@else
{{ Form::open(array('action'    =>  array('VlrInfoController@postEdit',$data->id),'method'  =>  'post','class'=>'container form-horizontal','role'=>'form')) }}
@endif
        <input type="hidden" name="is_init" value="0"/>
        <input type="hidden" name="validate_rule" value="0"/>
        <input type="hidden" name="sort_number" value="0"/>
        <input type="hidden" name="attr_remark" value="0"/>
        <div class="form-group">
            {{ Form::label('attr_name','字段名：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('attr_name',$data != null ? $data->attr_name : '',array('class'=>'form-control',"id"=>"attr_name", "placeholder"=>"字段名")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('attr_field_name','字段键名：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('attr_field_name',$data != null ? $data->attr_field_name : '',array('class'=>'form-control',"id"=>"attr_field_name", "placeholder"=>"字段键名")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('attr_des','字段描述信息：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('attr_des',$data != null ? $data->attr_des : '',array('class'=>'form-control',"id"=>"attr_des", "placeholder"=>"字段描述信息")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('attr_type','字段类型：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            <select name="attr_type" id="attr_type">
                @foreach($fieldTypeMap as $k => $v)
                <option {{ ($data && $data->attr_type == $k) ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('attr_extra','额外信息：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            <textarea name="attr_extra" id="" cols="30" rows="5">
                {{ $data != null ? $data->extra : '' }}
            </textarea>
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('attr_default_val','默认信息：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('attr_default_val',$data != null ? $data->attr_default_val : '',array('class'=>'form-control',"id"=>"attr_default_val", "placeholder"=>"默认信息")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('is_must','是否必填：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            <select name="is_must" id="is_must">
                <option {{ ($data && $data->is_must == 1) ? 'selected' : '' }} value="1">是</option>
                <option {{ ($data && $data->is_must == 0) ? 'selected' : '' }} value="0">否</option>
            </select>
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('is_active','是否显示：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            <select name="is_active" id="is_active">
                <option {{ ($data && $data->is_active == 1) ? 'selected' : '' }} value="1">是</option>
                <option {{ ($data && $data->is_active == 0) ? 'selected' : '' }} value="0">否</option>
            </select>
          </div>
        </div>

        <div class="form-group">
        {{ Form::label('','',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            <button type="submit" class="btn btn-material-amber">
            <i class="hgy-icon fa fa-check"></i>  保存  </button>
             <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
{{ Form::close() }}