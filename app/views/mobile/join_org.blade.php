<div class="container org-des">
<p>感谢您愿意成为我们的会员，完成下列资料

   填写即成为我们的会员！
</p>
</div>
<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="ui-form-item ui-border-b">
            <label for="#">姓名</label>
            <input id="userName" name="userName" type="text" placeholder="姓名">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">手机</label>
            <input name="userMobile" id="userMobile" type="text" placeholder="手机">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">邮箱</label>
            <input name="userEmail" id="userEmail" type="text" placeholder="邮箱">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-btn-wrap" id="submit">
            <button onclick="javascript:void(null);" class="ui-btn-lg ui-btn-primary">提交</button>
        </div>
    </form>
</div>
@section('scripts')
<script type="text/javascript">
var RULES = {
    'userEmail':    /[a-z0-9-]{1,30}@[a-z0-9-]{1,65}.[a-z]{3}/,
    'userMobile':   /^(13[0-9]{9})|(15[89][0-9]{8})$/,
    'userName': /^\s*[\s\S]{2,10}\s*$/
};
var ERROR_MSG = {
    'userEmail':    '请输入合法的Email地址',
    'userMobile':   '请输入正确的手机号',
    'userName': '字符长度大于2 小于10'
};

var el;

function getPostData() {
    var data = {};
    data['userName'] = $('#userName').val();
    data['userMobile'] = $('#userMobile').val();
    data['userEmail'] = $('#userEmail').val();

    var $inputs = $('input');
    $.each($inputs, function(e) {
        var _value = $(this).val();
        if(_value == '' || typeof _value == 'undefined') {
            $.dialog({
                title:'温馨提示',
                content:'请填写所有内容',
                button:["确认","取消"]
            });
            e.preventDefault();
            $(this).focus();

            return false;
        }

        var _key = $(this).attr('name');
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
    })
    return data;
}

!function($) {
    $('#submit').on('tap', function() {
        var data = getPostData();
        el = $.loading({
            content:'正在绑定...'
        });
        $.post('{{ URL::route('join_org', $orgId) }}', data, function(d) {
            setTimeout(function() {
                el.loading("hide");
            },500);
            if(d && d.errorCode == 0) {
                window.location.href = '{{ URL::action('mobile\HomeController@index', $orgId) }}';
            }
        });
    });
} (Zepto)
</script>
@endsection