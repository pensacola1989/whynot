{{ HTML::style('/styles/vol.css') }}
<div class="container">
<h2 class="row content-header">
  志愿者分组
</h2>

<table class="table table-hover">
  <thead>
    <tr>
      <th></th>
      <th>组名</th>
      <th>组人数</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach($group as $g)
    <tr>
      <td>{{ $g->id }}</td>
      <td>{{ $g->group_name }}</td>
      <td>{{ $g->vol_count }}</td>
      <td>
        <a href="{{ URL::action('VolgroupController@PostShow',['id' => $g->id]) }}" class="glyphicon glyphicon-pencil"></a>
        <a href="#" class="glyphicon glyphicon-remove"></a>
      </td>
    </tr>
    @endforeach
    <tr>
      <td>

      </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<div class="container">
<a href="{{ URL::action('VolgroupController@PostGroup') }}" class="btn btn-primary">
    <i class="glyphicon glyphicon-plus"></i>
    &nbsp;添加分组
</a>
</div>
</div>