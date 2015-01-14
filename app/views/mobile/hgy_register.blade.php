@section('styles')
<style type="text/css">
body{background-color: #FFF;}
.org-span{font-size:20px;}
.container{background-color: #EFEFEF;}
.ui-txt-info{text-align: center;}
ul li{text-align: center;}
p.ui-txt-info{text-align: left;padding-left: 30px;}
.hgy-mobile-header img{height: 45px;}
</style>
@endsection
<div class="container">
<h2 class="hgy-mobile-header">
    <img src="{{ URL::asset('images/home/hagongyi-3.png') }}" alt=""/>
    {{--<span style="font-size: 35px;">哈公益</span>--}}
</h2>
<p class="ui-txt-info">
    加入哈公益，数据你的公益人生！<br/>
    加入后，您可以：<br/>
    获得公益活动总时长<br/>
    找到最全的公益活动<br/>
    及时获得最全的活动信息<br/>
</p>
</div>
@if($errors->first())
<div class="ui-tooltips ui-tooltips-warn">
    <div class="ui-tooltips-cnt ui-tooltips-cnt-link ui-border-b">
        <i></i>{{ $errors->first() }}
    </div>
</div>
@endif
{{--{{ $errors->first() }}--}}
<div class="ui-form ui-border-t">
    <form id="reg_form" action="{{ URL::route('mobile_reg') }}" method="post">
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">邮箱:</label>
            <input name="email" type="text" placeholder="请输入邮箱">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">手机:</label>
            <input name="mobile" type="text" placeholder="请输入手机号码">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">密码:</label>
            <input type="password" name="password" type="text" placeholder="密码6-16，可特殊字符">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">密码确认:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" type="text" placeholder="请再次输入密码">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">姓名/昵称:</label>
            <input name="username" type="text" placeholder="请再次姓名/昵称">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-btn-wrap">
            <button type="submit" id="my_submit" onclick="javascript:void(null);" class="ui-btn-lg ui-btn-primary">确定</button>
        </div>
    </form>
</div>

@section('scripts')
<script type="text/javascript">
var RULES = {
    'email':    /[a-z0-9-]{1,30}@[a-z0-9-]{1,65}.[a-z]{3}/,
    'mobile':   /^(13[0-9]{9})|(15[89][0-9]{8})$/,
    'password': /^[\w]{4,16}$/,
    'username': /^\s*[\s\S]{2,10}\s*$/,
    'password_confirmation': /^[\w]{4,16}$/
}
var ERROR_MSG = {
    'email':    '请输入合法的Email地址',
    'mobile':   '请输入正确的手机号',
    'password': '密码6-16，可特殊字符',
    'password_confirmation': '密码6-16，可特殊字符',
    'username': '字符长度大于2 小于10'
}
function checkNull(e) {
    var $inputs = $('input');
    $.each($inputs, function() {
        var _value = $(this).val();
        if(_value == '' || typeof _value == 'undefined') {
            $.dialog({
                title:'温馨提示',
                content:'内容不为空',
                button:["确认","取消"]
            });
            e.preventDefault();
            $(this).focus();

            return false;
        }
        var _key = $(this).attr('name');
        if(_key != 'password_confirmation') {
            if(!RULES[_key].test(_value)) {
                $.dialog({
                    title: '错误提示',
                    content: ERROR_MSG[_key],
                    button:["确认","取消"]
                });
                e.preventDefault();
                $(this).focus();
                return false;
            }
        }
    });
    if($('input[name=password]').val() != $('#password_confirmation').val()) {
        $.dialog({
            title: '错误提示',
            content: '两次密码输入不一致',
            button:["确认","取消"]
        });

        $('#password_confirmation').focus();
        e.preventDefault();
        return false;
    }
    var _form = document.getElementById('reg_form');
    _form.submit();
}

!function($) {
    $(document).ready(function() {
        $('#my_submit').on('tap', function(){
            checkNull();
        });
    });
}(Zepto)
</script>
@endsection