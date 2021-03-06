@section('styles')
<style type="text/css">
.at-list a {display: block;width:100%;}
</style>
@endsection
<div class="ui-tab">
    <ul class="ui-tab-nav ui-border-b">
        <li>
            <a href="{{ URL::action('mobile\WcActivityController@latest', $orgId) }}">最新活动</a>
        </li>
        <li class="current">
            <a href="#">活动签到</a>
        </li>
        <li>
            <a href="{{ URL::action('mobile\WcActivityController@atHistory', $orgId) }}">活动历史</a>
        </li>
    </ul>
    <ul class="ui-tab-content at-list">
        <li>
            <ul class="ui-list ui-list-text ui-list-link ui-border-tb">
            @if(count($needSign))
            @foreach($needSign as $at)
                <li class="ui-border-t">
                    <a href="{{ URL::action('mobile\WcActivityController@getSign', $at->id) }}">
                        <p>{{ $at->title }}</p>
                    </a>
                </li>
            @endforeach
            </ul>
            @endif
        </li>
    </ul>
</div>