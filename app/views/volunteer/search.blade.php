{{ HTML::style('/styles/vol.css') }}
<div class="container">
<div class="page-header">
    <h2>志愿者列表</h2>
</div>
<div class="container search-panel">
<form method="GET" action="{{ action('VolunteerController@GetVolSearch') }}" class="form-inline search-form" role="form">
  <div class="form-group">
    <div class="input-group">
      <input type="email" class="form-control" name="volunteer_email" id="volunteer_email" placeholder="email">
    </div>
  </div>
  <div class="form-group">
      <div class="input-group">
        <input type="text" class="form-control" name="volunteer_name" id="volunteer_name" placeholder="姓名">
      </div>
    </div>
    <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" name="volunteer_mobile" id="volunteer_mobile" placeholder="电话">
    </div>
    </div>
    <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" name="volunteer_interest" id="volunteer_interest" placeholder="兴趣">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
          <select class="form-control" name="groupd_id" id="groupd_id" placeholder="分组">
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
<table class="table table-hover">
  <thead>
    <tr>
      <th>＃</th>
      <th>姓名</th>
      <th>分组</th>
      <th>手机</th>
      <th>邮箱</th>
      <th>兴趣</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach($volunteers as $v)
{{--    {{ dd($v->orgGroup);exit(); }}--}}
    <tr>
      <td></td>
      <td>{{ $v->volunteer_name }}</td>
      <td>{{ $v->groupd_id }}</td>
      <td>{{ $v->volunteer_mobile }}</td>
      <td>{{ $v->volunteer_email }}</td>
      <td>{{ $v->volunteer_interest }}</td>
      <td>{{ $v->is_verify }}</td>
      <td>
        <a href="javascript:void (null);" id="{{ $v->id }}" class="lock-vlt fa fa-lock" data-toggle="tooltip" data-placement="top" title="锁定"></a>
        <a href="javascript:void (null);" id="{{ $v->id }}" class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="查看"></a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<nav class="pager-container">

  {{ $volunteers ? $volunteers->appends($query)->links() : '' }}
</nav>
<div class="container" style="margin-top:0;margin-bottom: 20px;">
<a href="{{ URL::action('VolgroupController@PostGroup') }}" class="btn btn-primary">
    <i class="glyphicon glyphicon-plus"></i>
    &nbsp;添加分组
</a>
</div>
</div>
@section('scripts')
<script type="text/javascript">
function lockVtl() {
    var id = parseInt($(this).attr('id'));
    $.post('{{ route('lockvlt') }}', { id: id })
    .success(function(data) {

    })
    .error(function(){
        alert('操作失败');
    });
}
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('.lock-vlt').on('click',lockVtl);
});

</script>
@stop