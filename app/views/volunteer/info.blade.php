@section('styles')
<style type="text/css">
.list-group{border-radius: 0;}
.list-group-item:first-child,.list-group-item:last-child{border-radius: 0;}
.list-group-item .drg-handler:hover{color: #3498DB;cursor: move;}
.list-group-item.ui-sortable-helper{border:2x dotted #3498DB;}
.field-input{width:70px;}
.delete-link{display: block;color: #E74C3C;width: 70px;line-height: 19px;}
.edit-link{display: block;width: 70px;line-height: 19px;}
</style>
@endsection
<div class="page-header">
    <h2>
        志愿者信息收集
        <small>本设置用于志愿者加入组织填写，并且在发布活动时可通过自定义方式嵌入报名表单</small>
    </h2>
</div>
<div class="container hgy-form-control">
<a href="{{ action('VlrInfoController@editShow') }}" class="btn btn-primary">
    <i class="fa fa-plus"></i>
    &nbsp;&nbsp;添加
</a>
<a href="javascript:void (null);" class="btn btn-success">
<i class="fa fa-check"></i>
    &nbsp;&nbsp;保存
</a>
</div>
<div class="container">
<form action="">
<ul class="list-group" id="sortable">
  @if(count($attrs))
  @foreach($attrs as $a)
      <li class="list-group-item">
          <div class="drg-handler col-xs-2 col-md-1">
              ::::
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-2">
                <label>字段名:</label>
                <input type="text" name="field-name" class="field-input" value="{{ $a->attr_name }}"/>
            </div>
            <div class="col-xs-6 col-md-2">
                <select name="field-select" id="field-select">
                    @foreach($fieldTypeMap as $k => $v)
                    <option {{ $a->attr_type == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                    <option value="0">文本类型</option>
                </select>
            </div>
            <div class="col-xs-6 col-md-2">
                <input type="checkbox" name="is_must" class="is-must" {{ $a->is_must ? 'checked' :'' }}/>
                是否必填
            </div>
            <div class="col-xs-6 col-md-2">
                <input type="checkbox" name="is_show" class="is-show" {{ $a->is_active ? 'checked' : '' }}/>
                是否显示
            </div>
            <div class="drg-handler col-xs-2 col-md-1">
                 <a href="javascript:void (null);" class="delete-link">
                    <i class="fa fa-remove"></i>
                    &nbsp;&nbsp;
                    删除
                 </a>
                 <a href="{{ action('VlrInfoController@editShow',['id'=>$a->id]) }}" class="edit-link">
                     <i class="fa fa-pencil"></i>
                     &nbsp;&nbsp;
                     编辑
                  </a>
            </div>
          </div>
      </li>
  @endforeach
  @endif
</ul>

</div>
</form>
@section('scripts')
{{ HTML::script('http://libs.baidu.com/jqueryui/1.10.2/jquery-ui.min.js') }}
<script type="text/javascript">
$(function() {
    $('#sortable').sortable();
    $('#sortable').on('sortstart',function(e,ui){
          console.log(ui.helper);
//        $(ui.helper).addClass('current');
    });
})
</script>
@endsection