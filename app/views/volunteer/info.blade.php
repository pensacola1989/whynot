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
<a href="javascript:void (null);" class="btn btn-success save-sort" style="display: none;">
<i class="fa fa-check"></i>
    &nbsp;&nbsp;保存排序
</a>
</div>
<div class="container">
<form action="">
<div class="row">
             <div class="col-xs-2 col-md-1">
                  拖拽区
              </div>
            <div class="col-xs-6 col-md-2">
                <label class="info-label">字段名:</label>
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">字段类型</label>
            </div>
            <div class="col-xs-6 col-md-2">
               是否必填
            </div>
            <div class="col-xs-6 col-md-2">
                是否显示
            </div>
            <div class="drg-handler col-xs-2 col-md-1">
                 操作
            </div>
          </div>
<ul class="list-group" id="sortable">
  @if(count($attrs))
  @foreach($attrs as $a)
      <li class="list-group-item sorted-item" sort-num="{{ $a->sort_number }}">
          <div class="drg-handler col-xs-2 col-md-1">
              ::::
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-2">
                <label class="info-label">字段名:</label>
                <label>{{ $a->attr_name }}</label>
                {{--<input type="text" name="field-name" class="field-input" value="{{ $a->attr_name }}"/>--}}
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">{{ $a->attr_type }}</label>
                {{--<select name="field-select" id="field-select">--}}
                    {{--@foreach($fieldTypeMap as $k => $v)--}}
                    {{--<option {{ $a->attr_type == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>--}}
                    {{--@endforeach--}}
                    {{--<option value="0">文本类型</option>--}}
                {{--</select>--}}
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">{{ $a->is_must ? '是' : '否' }}</label>
                {{--<input type="checkbox" name="is_must" class="is-must" {{ $a->is_must ? 'checked' :'' }}/>--}}
                {{--是否必填--}}
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">{{ $a->is_active ? '是' : '否' }}</label>
                {{--<input type="checkbox" name="is_show" class="is-show" {{ $a->is_active ? 'checked' : '' }}/>--}}
                {{--是否显示--}}
            </div>
            <div class="drg-handler col-xs-2 col-md-1">
                 <a href="javascript:void (null);" class="delete-link" id="{{ $a->id }}">
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
function resort(event,ui) {
    var _items = $('.sorted-item');
    var _i = 0;
    var _len = _items.length;

    for(;_i < _len; _i++) {
        var _index = $(_items[_i]).index();
        $(_items[_i]).attr('sort-num',_index);
    }
    $('.save-sort').show();
}
$(function() {
    $('#sortable').sortable();
    $('#sortable').on('sortstart',function(e,ui){
    });
    $('#sortable').on('sortstop', resort);
    $('.delete-link').on('click', function() {
        var _confirm = confirm('确定删除？');
        if(!_confirm) return false;
        var _id = $(this).attr('id');
        $.post('{{ route('deleteAttr') }}', { id: _id})
        .success(function(data) {
            if(!data.errorCode) {
                alert(data.message);
                history.go(0);
            }
        });
    });
})
</script>
@endsection