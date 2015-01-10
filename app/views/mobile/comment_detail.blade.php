@section('styles')
<style type="text/css">
.hgy-mobile-header{width:100%;}
h2.hgy-mobile-header{background-color: #E67E22;}
h2.hgy-mobile-header span{color:#FFF;}
h2.hgy-mobile-header i{color:#FFF;}
.star-container{margin-left: 70px;}
</style>
@endsection
<h2 class="hgy-mobile-header ui-border-b">
    <i class="fa fa-comments-o"></i>&nbsp;&nbsp;
    <span style="font-size: 35px;">需要您评价活动</span>
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
            <label for="#">评分：</label>
            <div class="star-container">
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
            </div>
        </div>
        <div class="ui-form-item ui-form-item-textarea ui-border-b">
            <label for="#">建议/评语：</label>
            <textarea placeholder="在这里留下您都评价"></textarea>
        </div>
    </form>
</div>

<div class="ui-btn-wrap">
    <button class="ui-btn-lg ui-btn-primary">提交</button>
</div>