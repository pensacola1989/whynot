<div class="page-header">
    <h2>
        活动管理
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>活动列表</small>
    </h2>
</div>
<div class="container">
<form method="get" action="{{ URL::action('ActivityController@filter') }}">
<div class="row">
    <div class="col-md-2">
        <div class="radio radio-material-amber">
            <label>
              <input type="radio" name="filter" value="complete">
              已完成
            </label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="radio radio-material-amber">
            <label>
            <input type="radio" name="filter" value="during">
            正在进行
            </label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="radio radio-material-amber">
            <label>
            <input type="radio" name="filter" value="finish">
            已结束
            </label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="radio radio-material-amber">
        <label>
        <input type="radio" name="filter" value="unbegin">
        未开始
        </label>
        </div>
    </div>
    <div class="col-md-4">
        <button class="btn btn-material-amber">
            <i class="fa fa-filter"></i>
            &nbsp;
            筛选
        </button>
        <a href="{{ URL::action('ActivityController@filter') }}" class="btn btn-default">
            <i class="fa fa-close"></i>
            &nbsp;
            取消筛选
        </a>
    </div>
</div>
</form>
</div>
<div class="container">
<table class="table-list table table-hover">
        <thead>
        <tr>
            <th>活动名称</th>
            <th>活动内容简介</th>
            <th>活动地点</th>
            <th>活动状态</th>
            <th>操作</th>
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
            <a class="publish-btn" id="{{ $at->id }}" href="{{ URL::action('ActivityController@publishChannel', [$at->id, Auth::user()->Orgs()->first()->id]) }}"
                       data-toggle="tooltip" data-placement="top" title="" data-original-title="分享">
                <i class="fa fa-share-square-o"></i>
            </a>
            @if($at->is_published == 0)
                <a class="publish-btn" id="{{ $at->id }}" href="{{ URL::action('ActivityController@publishChannel', [$at->id, Auth::user()->Orgs()->first()->id]) }}"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="发布">
                    <i class="fa fa-send"></i>
                </a>
            @elseif($at->isBegin)
                <a class="modify-time" id="" href="{{ route('approve',$at->id )}}"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
            @else
            <a class="modify-time" id="" href="{{ route('approve',$at->id )}}"
                data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                <i class="fa fa-eye"></i>
            </a>
            @endif
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="pager-container">
        {{ $activities ? $activities->appends($searchFieldArr)->links() : '' }}
      {{--{{ $activities->links() }}--}}
    </nav>
</div>

@section('scripts')
<script type="text/javascript">
function queryParams(key) {
    var svalue = location.search.match(new RegExp("[\?\&]" + key + "=([^\&]*)(\&?)","i"));
    return svalue ? svalue[1] : svalue;
}
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
    var filter = queryParams('filter');
    if(filter != '') {
        $('input[value=' + filter + ']').attr('checked', true);
    }
//    $('input').iCheck();
//    $('.publish-btn').on('click', function() {
//        var _id = parseInt($(this).attr('id'));
//        publish(_id);
//    });
});
</script>
@endsection