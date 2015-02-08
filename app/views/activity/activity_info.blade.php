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
        活动信息编辑
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>设置活动报名的字段信息</small>
    </h2>
</div>
<div class="container hgy-form-control">
<a href="{{ action('ActivityController@editAtInfo') }}" class="btn btn-default">
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
            <div class="col-xs-6 col-md-1">
                <label class="info-label">字段名:</label>
            </div>
           <div class="col-xs-2 col-md-2">
                存储标识
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
      <li class="list-group-item sorted-item" sort-num="{{ $a->sort_number }}" id="{{ $a->id }}">
          <div class="drg-handler col-xs-2 col-md-1">
              ::::
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-1">
                <label>{{ $a->attr_name }}</label>
            </div>
            <div class="col-xs-6 col-md-2">
                <label>{{ $a->attr_field_name }}</label>
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">{{ $a->attr_type }}</label>
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">{{ $a->is_must == 1 ? '是' : '否' }}</label>
            </div>
            <div class="col-xs-6 col-md-2">
                <label for="">{{ $a->is_active == 1 ? '是' : '否' }}</label>
            </div>
            <div class="drg-handler col-xs-2 col-md-1">
                 <a href="javascript:void (null);" class="delete-link" id="{{ $a->id }}">
                    <i class="fa fa-remove"></i>
                    &nbsp;&nbsp;
                    删除
                 </a>
                 <a href="{{ action('ActivityController@editAtInfo', ['id' =>  $a->id]) }}" class="edit-link">
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
<a href="{{ URL::action('ActivityController@publishChannel', [$uid, $orgId]) }}" class="btn btn-material-amber">
    <i class="fa fa-arrow-right"></i>
    &nbsp;
    下一步
</a>
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

function savesort() {
    var _this = this;
    $(_this).attr('disabled',true);
    var _items = $('.sorted-item'),
        _len = _items.length,
        _i = 0,
        _ret = [];

    for(; _i < _len; _i++) {
        var _id = parseInt($(_items[_i]).prop('id'));
        var _sort_number = parseInt($(_items[_i]).attr('sort-num'));
        _ret.push({ id: _id, sort_number: _sort_number });
    }

    if(_ret.length) {
        $.post('{{ route('sortAt') }}',{ idSorts: JSON.stringify(_ret) })
        .success(function (data) {
            if(data.errorCode == 0) {
                alert(data.message);
                history.go(0);
            }
        })
        .done(function() {
            $(_this).removeAttr('disabled');
        });
    }
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
        $.post('{{ route('deleteInfoAt') }}', { id: _id})
        .success(function(data) {
            if(!data.errorCode) {
                alert(data.message);
                history.go(0);
            }
        });
    });
    $('.save-sort').on('click',savesort);
})
</script>
@endsection