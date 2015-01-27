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
            <td>
                <a href="{{ URL::action('ActivityController@atDetail', [Auth::User()->Orgs()->first()->id, $at->id]) }}">
                    {{ $at->title }}
                </a>
            </td>
            <td>{{ $at->content }}</td>
            <td>{{ $at->area }}</td>
            <td>{{ $at->status }}</td>
            <td>
            @if($at->is_verify == 1)
                <a class="publish-btn" id="{{ $at->id }}" href="javascript:void(null);"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="发布">
                    <i class="fa fa-send"></i>
                </a>
            @elseif($at->is_verify >= 1 && $at->isBegin)
                <a class="modify-time" id="" href="{{ route('approve',$at->id )}}"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
            @endif
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="pager-container">

      {{ $activities->links() }}
    </nav>
</div>

@section('scripts')
<script type="text/javascript">
function publish($activityId) {
    $.post('{{ route('atpub') }}', { activityId: $activityId })
    .success(function(data) {
        if(!data.errorCode) {
            alert(data.message);
            history.go(0);
        }
    })
    .error();
}
$(function() {
    $('.publish-btn').on('click', function() {
        var _id = parseInt($(this).attr('id'));
        publish(_id);
    });
});
</script>
@endsection