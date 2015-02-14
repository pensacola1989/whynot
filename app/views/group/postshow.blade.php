<div class="container" style="margin-top:130px;">
    @if(!$isEdit)
    {{ Form::open(array('action' =>  'VolgroupController@PostGroup','method'  =>  'post','class'=>'hgy-form form-horizontal','role'=>'form')) }}
    @else
    {{ Form::open(array('action' =>  'VolgroupController@PostEdit','method'  =>  'post','class'=>'hgy-form form-horizontal','role'=>'form')) }}
    <input type="hidden" name="id" value="{{ $group->id }}"/>
    @endif
      <div class="form-group">
        {{ Form::label('group_name','组名',array('style'=>'text-align:right;','class'   =>  'col-sm-2 control-label')) }}
        <div class="col-sm-10">
        {{ Form::text('group_name','',array('class'=>'form-control',"id"=>"group_name", "placeholder"=>"组名")) }}
        </div>
      </div>
        <div class="form-group">
        {{ Form::label('','',array('class'=>'control-label col-sm-2')) }}
          <div class="col-sm-10">
            <button type="submit" class="btn btn-material-amber">
              <i class="hgy-icon glyphicon glyphicon-ok"></i>
              {{ $isEdit ? '更新' : '添加' }}
            </button>
                  <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
    {{ Form::close() }}
</div>
