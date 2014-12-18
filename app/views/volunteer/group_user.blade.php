<div class="container">
<div class="page-header">
    <h2>
        <span style="color:#9d9d9d;">分组 |</span>{{ $group_users->group_name }}
        <small>共 <em style="color:#2ECC71;">{{ $group_users->volunteers->count() }}</em> 人</small>
    </h2>
</div>
<div class="container">
<table class="table-list table table-hover">
  <thead>
    <tr>
      <th>
        <label>
          #
        </label>
      </th>
      <th>姓名</th>
      <th>手机</th>
      <th>邮箱</th>
      <th>兴趣</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  @if($pagerData)
    @foreach($pagerData as $v)
{{--    {{ dd($v->orgGroup);exit(); }}--}}
    <tr>
      <td>
          <label>
            {{--<input id="{{ $v->id }}" type="checkbox" class="list-check">--}}
          </label>
      </td>
      <td>{{ $v->volunteer_name }}</td>
      <td>{{ $v->volunteer_mobile }}</td>
      <td>{{ $v->volunteer_email }}</td>
      <td>{{ $v->volunteer_interest }}</td>
      <td>{{ $v->is_verify }}</td>
      <td>
        <a href="{{ route('vltdtl',['vlrid' => $v->id]) }}" id="{{ $v->id }}" class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="查看"></a>
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
<nav class="pager-container">

  {{ $pagerData ->links() }}
</nav>
</div>
</div>