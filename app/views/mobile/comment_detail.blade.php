@section('styles')
<style type="text/css">
.hgy-mobile-header{width:100%;}
.hgy-mobile-header span{color:#333;}
/*h2.hgy-mobile-header{background-color: #E67E22;}*/
h2.hgy-mobile-header img{height:45px;}
h2.hgy-mobile-header span{color:#FFF;}
h2.hgy-mobile-header i{color:#FFF;}
.star-container{margin-left: 70px;}
.star-container .fa-star-o {color:#9d9d9d;}
.fa-star-o.stared {color:#E67E22;}
</style>
@endsection
{{--<h2 class="hgy-mobile-header ui-border-b">--}}
    {{--<i class="fa fa-comments-o"></i>&nbsp;&nbsp;--}}
    {{--<span style="font-size: 35px;">需要您评价活动</span>--}}
{{--</h2>--}}
<h2 class="hgy-mobile-header">
    <img src="{{ URL::asset('images/home/hagongyi-3.png') }}" alt=""/>
    <span style="color: #e91e63;font-weight: lighter;margin-left: 10px;">//</span>
    <span style="font-size: 30px;color:#333;line-height: 60px;">
    {{ $currentAt->BelongOrg->userinfos->u_username }}
    </span>
</h2>
<ul class="ui-list ui-list-text ui-list-cover ui-border-tb">
    <li class="ui-border-t">
        <p class="ui-txt-info">
            <i class="fa fa-file-text-o"></i>
            活动标题： {{ $currentAt->title }}
        </p>
    </li>
    <li class="ui-border-t">
        <p class="ui-txt-info">
            <i class="fa fa-clock-o"></i>
            时间： {{ $currentAt->start_time }}
        </p>
    </li>
    <li class="ui-border-t">
        <p class="ui-txt-info">
            <i class="fa fa-map-marker"></i>
            地点：{{ $currentAt->area }}
        </p>
    </li>
</ul>
<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="ui-form-item ui-border-b">
            <label style="width:50px;" for="#">评分：</label>
            <input type="hidden" name="rank"/>
            <div class="star-container">
                <i class="fa fa-star-o stared"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
            </div>
        </div>
        @if(!empty($comment) && $comment != '')
        <div class="ui-form-item ui-form-item-textarea ui-border-b">
            <label for="#">您的评价：</label>
            <br/>
            <h3>“{{ $comment }}”</h3>
            <br/>
        </div>
        @endif
        <div class="ui-form-item ui-form-item-textarea ui-border-b">
            <label for="#">建议/评语：</label>
            <textarea id="comment" placeholder="在这里留下您都评价"></textarea>
        </div>
    </form>
</div>

@if(!empty($comment) && $comment != '')
<div class="ui-btn-wrap">
    <button class="ui-btn-lg active">您已经评价</button>
</div>
@else
<div class="ui-btn-wrap">
    <button id="submit" onclick="javascript:void(null);" class="ui-btn-lg ui-btn-primary">提交</button>
</div>
@endif
@section('scripts')
<script type="text/javascript">
function initStar() {
    var $stars = $('.fa-star-o');
    $stars.on('tap', function(e) {
        var _index = $(e.target).index();
        var _i = 0;
        var _len = $stars.length;

        $('input[name=rank]').val(_index);
        for(; _i < _len; _i++) {
            if(_i > _index)
                $($stars[_i]).removeClass('stared');
            else
                $($stars[_i]).removeClass('stared').addClass('stared');
        }

    });
}

function postComment() {
    var el = $.loading({
                content:'提交中...'
            });
    $.post('{{ URL::action('mobile\VolunteerController@postComment', $currentAt->id) }}', {
        'rank': $('input[name=rank]').val(),
        'comment'  :   $('#comment').val()
    },function(data) {
        setTimeout(function() {
            el.loading("hide");
        },500);
        if(data && data.errorCode == 0) {
          //  window.location.href = '{{ URL::route('hgy_index') }}';
        }
    });
}

function initSubmit() {
    $('#submit').on('tap', function(e) {
        postComment();
        e.preventDefault();
        return false;
    });
}
!function($) {
    initStar();
    initSubmit();
} (Zepto)
</script>
@endsection