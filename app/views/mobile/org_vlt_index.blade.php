@section('styles')
<style type="text/css">
.link-a { display: block;width:100%;}
</style>
@endsection
<h2 class="hgy-mobile-header">

    <div class="ui-avatar-one">
        <span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>
    </div>
    <span style="font-size: 18px;line-height: 50px;">{{ $userData->username }}</span>

</h2>
<ul style="margin-bottom: 20px;" class="ui-list ui-list-text ui-list-link ui-border-tb">
    <li class="ui-border-t">
        <a class="link-a" href="">
            <p>
                <i class="fa fa-pencil"></i>
                &nbsp;&nbsp;
                修改个人资料
            </p>
        </a>
    </li>

</ul>

<ul class="ui-list ui-list-text ui-border-tb">
    <li class="ui-border-t ui-list-item-link">
        <div class="ui-list-info">
            <h4>您参加活动的总数</h4>
        </div>
        <div class="ui-badge">{{ $activityCount }}</div>
    </li>
    <li class="ui-border-t ui-list-item-link">
        <div class="ui-list-info">
            <h4>您评价的次数</h4>
        </div>
        <div class="ui-badge">{{ $commentCount }}</div>
    </li>
    <li class="ui-border-t  ui-list-item-link">
        <div class="ui-list-info">
            <h4>您的活动总小时数</h4>
        </div>
        <div class="ui-badge">{{ $totalTime }}</div>
    </li>
</ul>