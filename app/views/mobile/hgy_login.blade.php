@section('styles')
<style type="text/css">
body{background-color: #FFF;}
.org-span{font-size:20px;}
.container{background-color: #EFEFEF;}
.ui-txt-info{text-align: center;}
.hgy-mobile-header img{height: 45px;}
</style>
@endsection
<div class="container">
<h2 class="hgy-mobile-header">
    <img src="{{ URL::asset('images/home/hagongyi-3.png') }}" alt=""/>
    {{--<span style="font-size: 35px;">登录哈公益</span>--}}
</h2>
<p class="ui-txt-info">
    立刻登录哈公益，增加您的活动时间
</p>
</div>

<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input name="emailOrMobile" type="text" placeholder="手机号/邮箱">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input name="password" type="password" placeholder="密码">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-btn-wrap">
            <button id="login-btn" onclick="javascript:void(null);" class="ui-btn-lg ui-btn-primary">登录</button>
        </div>
    </form>
</div>

@section('scripts')
<script type="text/javascript">

function checkLogin() {

}

!function($) {
    $(document).ready(function() {
        var isLoginCheck = false;

        $('#login-btn').on('tap', function() {
            var el = $.loading({
                content:'登录中...'
            });

            var _credential = $('input[name=emailOrMobile]').val();
            var _password = $('input[name=password]').val();

            $.post('{{ URL::route('loginToHgy') }}', {
                'emailOrMobile': _credential,
                'password'  :   _password
            },function(data) {
                setTimeout(function() {
                    el.loading("hide");
                },500);
                if(data && data.errorCode == 0) {
                    alert('success');
                }
            });
        });
    });
}(Zepto)
</script>
@endsection

