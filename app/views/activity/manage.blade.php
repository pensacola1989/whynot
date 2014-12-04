<div class="page-header">
    <h2>
        活动管理
        <small>活动列表</small>
    </h2>
</div>
<div class="container">
<table class="table-list table table-hover">
        <thead>
        <tr>
            <th>活动名称</th>
            <th>活动内容简介</th>
            <th>活动地点</th>
            <th>活动状态</th>
            <th>查看报名</th>
        </tr>
        </thead>
        <tbody>
        @if(count($activities))
        @foreach($activities as $at)
        <tr>
            <td>{{ $at->title }}</td>
            <td>{{ $at->content }}</td>
            <td>{{ $at->area }}</td>
            <td>{{ $at->status }}</td>
            <td>
                <a class="modify-time" id="" href="{{ route('approve',$at->id )}}"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="pager-container">

      {{ $activities->links() }}
    </nav>
</div>