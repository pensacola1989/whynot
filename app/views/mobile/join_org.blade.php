<div class="container org-des">
<p>感谢您愿意成为我们的会员，完成下列资料

   填写即成为我们的会员！
</p>
</div>
<div class="ui-form ui-border-t">
        <div class="ui-form-item ui-border-b">
            <label for="#">姓名</label>
            <input class="base" id="userName" name="userName" type="text" placeholder="姓名">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">手机</label>
            <input class="base" name="userMobile" id="userMobile" type="text" placeholder="手机">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-border-b">
            <label for="#">邮箱</label>
            <input class="base" name="userEmail" id="userEmail" type="text" placeholder="邮箱">
            <a href="#" class="ui-icon-close"></a>
        </div>

    <p class="container">请填写组织用户自定信息</p>
    <div class="ui-form ui-border-t">
        @if(count($vltAttributes))
        @foreach($vltAttributes as $attr)
        @if($attr->attr_type == 'text')
        <div class="customizeText ui-border-b">
            <label for="#">{{ $attr->attr_name }}</label>
            <input name="{{ $attr->attr_field_name }}" type="text" placeholder="{{ $attr->attr_name }}">
            <a href="#" class="ui-icon-close"></a>
        </div>
        @elseif($attr->attr_type == 'enum')
        <div class="customizeEnum">
            <label for="#">{{ $attr->attr_name }}</label>
            <br/>
            {{ $attr->parseEnum }}
        </div>
        @elseif($attr->attr_type == 'radio')
        <div class="customizeRadio">
            <label for="#">{{ $attr->attr_name }}</label>
                <br/>

        {{ $attr->parseRadio }}
        </div>
        @endif
        @endforeach
        @endif
        <div class="ui-btn-wrap" id="submit" style="margin-top:100px;margin-bottom:50px;">
            <button onclick="javascript:void(null);" class="ui-btn-lg ui-btn-primary">提交</button>
        </div>
    </div>

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
var cmzDataGenerator = {};
cmzDataGenerator.getText = function(obj) {
    if(!$('.customizeText')) return;
    var $textInputs = $('.customizeText').find('input').first();
    obj[$textInputs.attr('name')] = $textInputs.val();
    return obj;
};
cmzDataGenerator.getEnum = function(obj) {
    if(!$('.customizeEnum')) return;
    var _arr = [];

    var $textInputs = $('.customizeEnum').find('input:checked');
    if($textInputs.length) {
        $.each($textInputs, function() {
            _arr.push($(this).val());
        });
    }
    obj[$textInputs.first().attr('name')] = _arr.length ? _arr : '';
    return obj;
};

cmzDataGenerator.getRadio = function(obj) {
    if(!$('.customizeRadio')) return;
    var $radioInput = $('.customizeRadio').find('input:checked').first();

    obj[$radioInput.attr('name')] = $radioInput.val();
    return obj;
}

function getFieldData() {
    var obj = {};
    // get text inputs
    for(var d in cmzDataGenerator) {
        if(typeof cmzDataGenerator[d] == 'function') {
            cmzDataGenerator[d](obj);
        }
    }
    return JSON.stringify(obj);
}

function getPostData() {
    var data = {};
    var isValid = true;
    data['userName'] = $('#userName').val();
    data['userMobile'] = $('#userMobile').val();
    data['userEmail'] = $('#userEmail').val();

    var $inputs = $('input.base');
    $.each($inputs, function() {
        var _value = $(this).val();
        if(_value == '' || typeof _value == 'undefined') {
            $.dialog({
                title:'温馨提示',
                content:'请填写所有内容',
                button:["确认","取消"]
            });
            $(this).focus();
            isValid = false;
            return false;
        }

        var _key = $(this).attr('name');
        if(!RULES[_key].test(_value)) {
            $.dialog({
                title: '错误提示',
                content: ERROR_MSG[_key],
                button:["确认","取消"]
            });
            $(this).focus();
            isValid = false;
            return false;
        }
    })
    return isValid == true ? data : false;
}

!function($) {
    $('#submit').on('tap', function(e) {
        var data = getPostData(e);
        if(!data) {
            e.preventDefault();
            return false;
        }
        data['values'] = getFieldData();
        el = $.loading({
            content:'正在绑定...'
        });
        $.post('{{ URL::route('join_org', $orgId) }}', data, function(d) {
            setTimeout(function() {
                el.loading("hide");
            },500);
            if(d && d.errorCode == 0) {
                return false;
                window.location.href = '{{ URL::action('mobile\HomeController@index', $orgId) }}';
            }
        });
    });
} (Zepto)
</script>
@endsection