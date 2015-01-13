<ul class="ui-list ui-list-text ui-border-tb">
    @if(count($activities))
    @foreach($activities as $at)
    <li class="ui-border-t ui-list-item-link">
        <a href="{{ $type == 1 ? URL::action('mobile\ActivityController@atRegister', $at->Activity->id)
            : URL::action('mobile\VolunteerController@commentDetail', $at->Activity->id)
        }}">
        <div class="ui-list-info">
        @if($type == 1)
            <h4>{{ $at->Activity->title }}</h4>
            <p>结束时间 {{ $at->Activity->end_time }}</p>
        @elseif($type == 0)
            <h4>{{ $at->vol_reply }}</h4>
            <p>评价时间 {{ $at->created_at }}</p>
        @endif

        </div>
        <div class="ui-list-action">
            @if($type == 1)
            <i class="fa fa-eye"></i>
            @elseif($type == 0)
            <i class="fa fa-comment-o"></i>
            @endif
        </div>
        </a>
    </li>
    @endforeach
    @endif
</ul>