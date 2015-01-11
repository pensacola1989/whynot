@section('styles')
<style type="text/css">
.ui-list a{display:block;width:100%;}
</style>
@endsection
<ul class="ui-list ui-list-text ui-border-tb">
    @if(count($userCommentList))
    @foreach($userCommentList as $cmt)
    <li class="ui-border-t ui-list-item-link">
        <a href="{{ URL::action('mobile\VolunteerController@commentDetail', $cmt->Activity->id) }}">
            <div class="ui-list-info">
                <h4>{{ $cmt->Activity->title }}</h4>
                <p>{{ $cmt->vol_reply }}</p>
            </div>
        </a>
        {{--<div class="ui-badge">123</div>--}}
    </li>
    @endforeach
    @endif
</ul>