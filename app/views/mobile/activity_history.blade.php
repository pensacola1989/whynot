<div class="ui-tab">
    <ul class="ui-tab-nav ui-border-b">
        <li>
            <a href="{{ URL::action('mobile\WcActivityController@latest', $orgId) }}">最新活动</a>
        </li>
        <li>
            <a href="">活动签到</a>
        </li>
        <li class="current">
            <a href="">活动历史</a>
        </li>
    </ul>
    <ul class="ui-tab-content">
        <li>
            {{--<h2 class="hgy-mobile-header">--}}

                {{--<div class="ui-avatar-one">--}}
                    {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>--}}
                {{--</div>--}}
                {{--<span style="font-size: .8em;">爱心社活动历史</span>--}}

            {{--</h2>--}}

            <div class="ui-scroller">
            <ul class="ui-list ui-border-tb">
                @if(count($atHistory))
                @foreach($atHistory as $at)
                <li>
                    <div class="ui-avatar-s">
                       <span style="background-image:url(http://icase.tencent.com/vlabs/img/?100*100)"></span>
                    </div>
                    <div class="ui-list-info ui-border-t">
                        <h4>{{ $at->title }}</h4>
                        <p>
                            {{ $at->content }}
                            <span class="date-holder">
                                {{ $at->end_time }}
                            </span>
                        </p>
                        @if($at->isRegister)
                        <a href="{{ URL::action('mobile\VolunteerController@commentDetail', $at->id) }}" class="link-a ui-btn">
                            <i class="fa fa-comment-o"></i>&nbsp;评价
                        </a>
                        @else
                        <a href="{{ URL::route('mobile_regat', $at->id) }}" class="link-a ui-btn">
                            <i class="fa fa-comment-o"></i>&nbsp;查看
                        </a>
                        @endif
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        </li>
    </ul>
</div>
@section('scripts')
<script type="text/javascript">
!function($) {
    $(document).ready(function() {
        $('.link-a').on('tap', function() {
            window.location.href = $(this).attr('href');
        });
//        var scroller = new Scroll('.ui-scroller');
    });
}(Zepto)
</script>
@endsection