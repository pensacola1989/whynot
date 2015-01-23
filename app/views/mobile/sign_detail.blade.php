@section('styles')
<style type="text/css">
html {
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -webkit-user-select: none;
  user-select: none;
}
body {
  line-height: 1.6;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  background-color: #f1f0f6;
}
* {
  margin: 0;
  padding: 0;
}
button {
  font-family: inherit;
  font-size: 100%;
  margin: 0;
  *font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
ul,
ol {
  padding-left: 0;
  list-style-type: none;
}
a {
  text-decoration: none;
}
.label_box {
  background-color: #ffffff;
}
.label_item {
  padding-left: 15px;
}
.label_inner {
  padding-top: 10px;
  padding-bottom: 10px;
  min-height: 24px;
  position: relative;
}
.label_inner:before {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 200%;
  height: 1px;
  border-top: 1px solid #ededed;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scale(0.5);
  transform: scale(0.5);
  top: auto;
  bottom: -2px;
}
.lbox_close {
  position: relative;
}
.lbox_close:before {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 200%;
  height: 1px;
  border-top: 1px solid #ededed;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scale(0.5);
  transform: scale(0.5);
}
.lbox_close:after {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 200%;
  height: 1px;
  border-top: 1px solid #ededed;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scale(0.5);
  transform: scale(0.5);
  top: auto;
  bottom: -2px;
}
.lbox_close .label_item:last-child .label_inner:before {
  display: none;
}
.btn {
  display: block;
  margin-left: auto;
  margin-right: auto;
  padding-left: 14px;
  padding-right: 14px;
  font-size: 18px;
  text-align: center;
  text-decoration: none;
  overflow: visible;
  /*.btn_h(@btnHeight);*/
  height: 42px;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  color: #ffffff;
  line-height: 42px;
  -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
}
.btn.btn_inline {
  display: inline-block;
}
.btn_primary {
  background-color: #04be02;
}
.btn_primary:not(.btn_disabled):visited {
  color: #ffffff;
}
.btn_primary:not(.btn_disabled):active {
  color: rgba(255, 255, 255, 0.9);
  background-color: #039702;
}
button.btn {
  width: 100%;
  border: 0;
  outline: 0;
  -webkit-appearance: none;
}
button.btn:focus {
  outline: 0;
}
.wxapi_container {
  font-size: 16px;
}
h1 {
  font-size: 14px;
  font-weight: 400;
  line-height: 2em;
  padding-left: 15px;
  color: #8d8c92;
}
.desc {
  font-size: 14px;
  font-weight: 400;
  line-height: 2em;
  color: #8d8c92;
}
.wxapi_index_item a {
  display: block;
  color: #3e3e3e;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
.wxapi_form {
  background-color: #ffffff;
  padding: 0 15px;
  margin-top: 30px;
  padding-bottom: 15px;
}
h3 {
  padding-top: 16px;
  margin-top: 25px;
  font-size: 16px;
  font-weight: 400;
  color: #3e3e3e;
  position: relative;
}
h3:first-child {
  padding-top: 15px;
}
h3:before {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 200%;
  height: 1px;
  border-top: 1px solid #ededed;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scale(0.5);
  transform: scale(0.5);
}
.btn {
  margin-bottom: 15px;
}


</style>
@endsection

<div class="ui-form ui-border-t" style="margin:20px 0;">
@if(!$isSign)
    <form action="#" >
        <div class="ui-form-item ui-border-b">
            <label for="#">签到码</label>
            <input id="signCode" type="text" placeholder="请输入签到码">
            <a href="#" class="ui-icon-close"></a>
        </div>
    </form>
</div>

<div class="container">
<div class="ui-btn-wrap">
    <button class="btn btn_primary" id="signByCode">签到</button>
    <button class="ui-btn-lg" style="color:#04be02;">扫码签到</button>
</div>
</div>
@else
<section class="ui-notice">
      <i></i>
      <p>您已经签过到</p>
</section>
@endif
@section('scripts')
<script type="text/javascript">

var el;

function postSign(signCode, activityId) {

    el = $.loading({
        content:'正在操作...'
    });
    $.post('{{ URL::action('mobile\WcActivityController@postSign') }}', {
        'activity_id': activityId,
        'sign_code'  :   signCode
    },function(data) {
        setTimeout(function() {
            el.loading("hide");
        },500);
        if(data && data.errorCode == 0) {
            alert('签到成功');
//            window.location.href = '';
        }
    });
}
!function($) {
    $('#signByCode').on('click', function() {
        postSign($('#signCode').val(), '{{ $activityId }}');
    });
} (Zepto)
</script>
@endsection