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
    修改密码
</p>
</div>

<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="step1">
            <div class="ui-form-item ui-form-item-pure ui-border-b">
                <input name="oldPass" type="password" placeholder="旧密码">
                <a href="#" class="ui-icon-close"></a>
            </div>
            <div class="ui-btn-wrap">
                <button id="next-btn" onclick="javascript:void(null);" class="ui-btn-lg ui-btn-default">下一步</button>
            </div>
        </div>
        <div class="step2" style="display: none;">
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input id="newPass" name="password" type="password" placeholder="新密码">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input id="newPass2" name="password" type="password" placeholder="密码确认">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-btn-wrap">
            <button id="update-btn" onclick="javascript:void(null);" class="ui-btn-lg ui-btn-primary">修改</button>
        </div>
        </div>
    </form>
</div>

@section('scripts')
<script type="text/javascript">

function checkLogin() {

}
function checkPass(oldPass) {
    $.post('{{ URL::route('check_pass') }}', {
        'old_pass': oldPass
    }, function(data) {
        if(data == 1) {
            $('.step1').hide();
            $('.step2').show();
        }
    });
}

function isPassMatch() {
    return $('#newPass').val() == $('#newPass2').val();
}

function updatePass(e) {
    var pass = $('#newPass').val();
    var pass2 = $('#newPass2').val();

    if(!/^[\w]{4,16}$/.test(pass)) {
        $.dialog({
            title: '错误提示',
            content: '密码6-16，可特殊字符',
            button:["确认"]
        });
        return false;
    }
    if(pass != pass2) {
        $.dialog({
            title: '错误提示',
            content: '两次密码输入不一致',
            button:["确认"]
        });
        return false;
    }

    $.post('{{ URL::route('update_pass') }}', {
        'new_pass': pass2
    }, function(data) {
        if(data && data.errorCode != 0) {
            $.dialog({
                title: '错误提示',
                content: '操作失败',
                button:["确认"]
            });
        }
        else {
            $('body').append('<div class="ui-tips ui-tips-success"><i></i>修改成功</div>');
            setTimeout(function() {
                window.location.href = '{{ URL::route('hgy_index') }}';
            }, 500);
        }
    });

}
!function($) {
    $(document).ready(function() {
        $('#next-btn').on('tap', function(e) {
            var oldPass = $('input[name=oldPass]').val();
            if(oldPass == '')  {
                e.preventDefault();
                return false;
            }
            checkPass(oldPass);
        });

        $('#update-btn').on('tap', updatePass);
    });
}(Zepto)
</script>
@endsection

