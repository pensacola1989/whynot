
<div class="page-header">
    <h2>
        活动总结
        <small>请填写活动相关得总结信息</small>
    </h2>
</div>
<div class="container">
<table class="table-list table table-hover">
  <thead>
    <tr>
      <th>活动名称</th>
      <th>状态</th>
      <th>报名数/审核数</th>
      <th>发布时间</th>
      <th>计划进行时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  @foreach($activities as $at)
      <tr>
          <td>{{ $at->title }}</td>
          <td>{{ $at->status }}</td>
          <td>{{ '<em style="color:#DDD;">' . $at->request_num.'</em>/'.'<em style="color:#2ECC71;">'.$at->approve_num . '</em>' }}</td>
          <td>{{ $at->created_at }}</td>
          <td><em>{{ $at->planDuration }}</em></td>
          <td>
          @if($at->isEdit)
            {{ $at->controlPannel }}
          @endif
          </td>
    </tr>
  @endforeach
  </tbody>
</table>
<nav class="pager-container">

  {{ $activities->links() }}
</nav>

</div>