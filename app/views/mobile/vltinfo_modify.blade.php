@section('styles')
<style type="text/css">
.hgy-mobile-header{background-color: #EFEFEF;width:100%;}
</style>
@endsection
{{--<h2 class="hgy-mobile-header">--}}
    {{--<div class="ui-avatar-one">--}}
        {{--<span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>--}}
    {{--</div>--}}
    {{--<span>哈公益</span>--}}
{{--</h2>--}}
<h2 class="hgy-mobile-header">
    <img src="{{ URL::asset('images/home/hagongyi-3.png') }}" style="height:45px;" alt=""/>
    {{--<span style="font-size: 35px;">登录哈公益</span>--}}
</h2>
<div class="ui-form ui-border-t">
    <form action="#" method="post">
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">姓名/昵称：</label>
            <input class="mod-form-item" name="username" type="text">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">邮箱：</label>
            <input class="mod-form-item" name="email" type="text">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">电话：</label>
            <input class="mod-form-item" name="mobile" type="text">
            <a href="#" class="ui-icon-close"></a>
        </div>
        {{--<div class="ui-form-item ui-form-item-l ui-border-b">--}}
                {{--<label class="ui-border-r">爱好：</label>--}}
                {{--<input type="text" placeholder="逗号分割">--}}
                {{--<a href="#" class="ui-icon-close"></a>--}}
            {{--</div>--}}
        <div class="ui-btn-wrap">
            <button class="ui-btn-lg ui-btn-danger">
                <i class="fa fa-pencil"></i>
                &nbsp;&nbsp;修改
            </button>
        </div>
    </form>
</div>
@section('scripts')
<script type="text/javascript">
function getData() {
    var _ret = {};
    var _$items = $('.mod-form-item');
    var _len = _$items.length;
    var _i = 0;
    if(!_len) return;
    for(; _i < _len; _i++) {
        var _key = $(_$items[_i]).attr('name');
        _ret[_key] = $(_$items[_i]).val();
    }
    return _ret;
}
!function($) {
    $('button').on('tap', function(e) {
        var el = $.loading({
            content:'正在提交...'
        });
        var data = getData();
         $.post('{{ URL::action('mobile\VolunteerController@postInfoForHgyEdit', Auth::user()->id ) }}', data ,function(d) {
            setTimeout(function() {
                el.loading("hide");
            },500);
            if(d && d.errorCode == 0) {
                window.location.href = '{{ URL::route('hgy_index') }}';
            }
         });
        e.preventDefault();
        return false;
    });
} (Zepto)
</script>
@endsection