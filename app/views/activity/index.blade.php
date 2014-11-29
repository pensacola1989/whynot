{{ HTML::style('/styles/activity.css') }}
<div class="container">
<div class="page-header">
    <h2>活动情况</h2>
    <a class="btn btn-primary" href="/index.php/activity/publish" role="button">发布活动</a>
</div>
<div class="container search-panel">
<form method="GET" action="" class="form-inline search-form" role="form">
  <span>快速查询</span>
  <div class="form-group">
    <div class="input-group">
      <input type="email" class="form-control" name="activity" id="activity" placeholder="活动">
    </div>
  </div>

  <button type="submit" class="btn btn-success">
    <i class="fa fa-search"></i>&nbsp;&nbsp;查找
  </button>
</form>
</div>
<div class="container control-pannel" style="display: none;">
    <label href="#" >
        <i class="fa fa-mail-forward"></i>
            转移至分组
    </label>
  <select class="form-control" name="targetgroup" id="targetgroup" style="display: inline-flex;width:120px;">

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
      <th>正在展开的活动</th>
      <th>报名数/审核数</th>
      <th>发布时间</th>
      <th>计划进行时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<table class="table-list table table-hover">
  <thead>
    <tr>
      <th>
        <label>
          <input type="checkbox" class="list-check" id="checkall">
        </label>
      </th>
      <th>需总结的活动</th>
      <th>默认活动时长</th>
      <th>实际活动时间</th>
      <th>参加人数</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
<nav class="pager-container">

</nav>
<div class="container" style="margin-top:0;margin-bottom: 20px;">

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
            history.go(0);
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