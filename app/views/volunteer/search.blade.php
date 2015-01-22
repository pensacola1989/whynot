{{ HTML::style('/styles/vol.css') }}
<div class="container">
<div class="page-header">
    <h2>志愿者列表</h2>
</div>
<div class="container search-panel">
<form method="GET" action="{{ action('VolunteerController@GetVolSearch') }}" class="form-inline search-form" role="form">
  <div class="form-group">
    <div class="input-group">
      <input type="email" class="form-control" name="email" id="volunteer_email" placeholder="email">
    </div>
  </div>
  <div class="form-group">
      <div class="input-group">
        <input type="text" class="form-control" name="username" id="volunteer_name" placeholder="姓名">
      </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" name="mobile" id="volunteer_mobile" placeholder="电话">
    </div>
    </div>
    {{--<div class="form-group">--}}
        {{--<div class="input-group">--}}
          {{--<input type="text" class="form-control" name="volunteer_interest" id="volunteer_interest" placeholder="兴趣">--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group">
        <div class="input-group">
          <select class="form-control" name="group_id" id="group_id" placeholder="分组">
            <option value="-1">不限</option>
            @if(count($groups))
            @foreach($groups as $g)
                <option value="{{ $g->id }}">{{ $g->group_name }}</option>
            @endforeach
            @endif
          </select>
        </div>
    </div>
  <button type="submit" class="btn btn-success">
    <i class="fa fa-search"></i>&nbsp;&nbsp;搜索
  </button>
</form>
</div>
<div class="container control-pannel" style="display: none;">
    <label href="#" >
        <i class="fa fa-mail-forward"></i>
            转移至分组
    </label>
  <select class="form-control" name="targetgroup" id="targetgroup" style="display: inline-flex;width:120px;">
    {{--<option value="-1">不限</option>--}}
    @if(count($groups))
    @foreach($groups as $g)
        <option value="{{ $g->id }}">{{ $g->group_name }}</option>
    @endforeach
    @endif
  </select>
  <a href="#" class="btn btn-primary confirm-checked">
    <i class="fa fa-check"></i>
    &nbsp;&nbsp;确定
  </a>
    <a href="javascript:void(null);" class="btn btn-default batch-lock">
        <i class="fa fa-lock"></i>
        &nbsp;批量冻结
    </a>
</div>
<table class="table-list table table-hover">
  <thead>
    <tr>
      <th>
        <label>
          <input type="checkbox" class="list-check" id="checkall">
        </label>
      </th>
      <th>姓名</th>
      <th>分组</th>
      <th>手机</th>
      <th>邮箱</th>
      {{--<th>兴趣</th>--}}
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach($volunteers as $v)
{{--    {{ dd($v->orgGroup);exit(); }}--}}
    <tr>
      <td>
          <label>
            <input id="{{ $v->id }}" type="checkbox" class="list-check">
          </label>
      </td>
      <td>{{ $v->username }}</td>
      <td>{{ $v->pivot->group_id }}</td>
      <td>{{ $v->mobile }}</td>
      <td>{{ $v->email }}</td>
      {{--<td>{{ $v->volunteer_interest }}</td>--}}
      <td>
        {{ $v->pivot->is_verify == 1 ? '<em style="color:green">已审核</em>' :'<em style="color:orange;">未审核</em>'}}
      </td>
      <td>
        <a href="javascript:void (null);" id="{{ $v->pivot->vol_id }}"
            class="{{ !$v->pivot->is_lock ? 'lock-vlt' : 'unlock-vlt'}} fa {{ $v->pivot->is_lock != 1 ? 'fa-lock' : 'fa-unlock' }}"
            data-toggle="tooltip" data-placement="top" title="{{!$v->pivot->is_lock ? '锁定' : '解锁'}}"></a>
        <a href="{{ route('vltdtl',['vlrid' => $v->id]) }}" id="{{ $v->id }}" class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="查看"></a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<nav class="pager-container">

  {{ $volunteers ? $volunteers->appends($query)->links() : '' }}
</nav>
<div class="container" style="margin-top:0;margin-bottom: 20px;">
{{--<a href="{{ URL::action('VolgroupController@PostGroup') }}" class="btn btn-primary">--}}
    {{--<i class="glyphicon glyphicon-plus"></i>--}}
    {{--&nbsp;添加分组--}}
{{--</a>--}}
</div>
</div>
@section('scripts')
<script type="text/javascript">
function initBatch() {
    var isAllcheck = false;
    var selectedArr = [];

    $('.list-check').on('click',function(e) {
        var $checkbox = $('.table-list tr td:first-child .list-check')
        if($(e.target).attr('id') == 'checkall') {
            if(isAllcheck == false)  $checkbox.prop('checked',true);
            else $checkbox.removeAttr('checked');
            isAllcheck = !isAllcheck;
        }
        if($('.table-list tr td:first-child .list-check:checked').length)  $('.control-pannel').show();
        else  $('.control-pannel').hide();
    });
}

function confirmTocheck(e) {
    var _type = e.data.type;
    var _idArr = getSelectedData();
    var _targetData = _type == 'changegroup' ?  $('#targetgroup').val() :'';


    $.post('{{ route('batch') }}',{ type: _type, ids: JSON.stringify(_idArr), target: _targetData })
    .success(function(data) {
        if(data.errorCode == 0) {
            alert(data.message);
            history.go(0);
        }
    })
    .error(function() {

    });
}

function getSelectedData() {
    var ret = [];
    var checked = $('.table-list tr td:first-child .list-check:checked');
    var i = 0;
    if(!checked.length) {
        alert('请选择');
        return false;
    }
    for(; i < checked.length; i++) {
        ret.push(parseInt($(checked[i]).attr('id')));
    }
    return ret;
}
function lockVtl(e) {
    alert(e.data.lock);
    var id = parseInt($(this).attr('id'));
    $.post('{{ route('lockvlt') }}', { type: e.data.lock, id: id })
    .success(function(data) {
        if(data.errorCode == 0) {
//            history.go(0);
        }
    })
    .error(function(){
        alert('操作失败');
    });
}
$(function() {
    initBatch();
    $('[data-toggle="tooltip"]').tooltip();
    $('.lock-vlt').on('click', null, { lock: 0 }, lockVtl);
    $('.unlock-vlt').on('click', null, { lock: 1 }, lockVtl);
    $('.batch-lock').on('click',null,{type: 'lock'}, confirmTocheck);
    $('.confirm-checked').on('click', null, {type: 'changegroup'}, confirmTocheck);
});

</script>
@stop