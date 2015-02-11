@section('styles')
{{ HTML::style('/styles/bootstrap-switch.min.css') }}
<style type="text/css">
.nav.nav-pills {
margin-bottom: 10px;
}
.org_des{
    height: 50px;
    border: none;
}
.org_des_item {
    color:#FFF;
    background-color: #337ab7;
    border-top: 1px solid #eee;
    height: 50px;
    line-height: 50px;
    text-align: center;
}
.org_des_item.current{
background-color: #FFF;
}
</style>
@endsection
<div class="page-header">
    <h2>
        管理活动
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>平台方审核公益组织活动</small>
    </h2>
</div>
<div class="container">
<div class="row" style="width:550px;">
    <div class="col-md-3" style="line-height: 35px;padding-left: 20px;">
    筛选条件
    </div>
  <div class="col-md-3">
    <div class="chk-filter checkbox checkbox-material-amber">
        <label>
          <input url="{{ action('PlatformController@activityManager') }}" type="checkbox" {{ $isVerify == null ? 'checked' : '' }}> 无
        </label>
      </div>
  </div>
  <div class="col-md-3">
    <div class="chk-filter checkbox checkbox-material-amber">
        <label>
          <input url="{{ action('PlatformController@activityManager', 1) }}" type="checkbox" {{ $isVerify == 1 ? 'checked' : '' }}> 已审核
        </label>
      </div>
  </div>
  <div class="col-md-3">
    <div class="chk-filter checkbox checkbox-material-amber">
        <label>
          <input url="{{ action('PlatformController@activityManager', 0) }}" type="checkbox" {{ $isVerify == 0 && $isVerify != null ? 'checked' : '' }}> 未审核
        </label>
      </div>
  </div>
</div>
{{--<ul class="nav nav-pills">--}}
{{--<li><label>筛选条件：</label></li>--}}
  {{--<li role="presentation" class="{{ $isVerify == null ? 'active' : '' }}">--}}
    {{--<a href="{{ action('PlatformController@activityManager') }}">无</a>--}}
    {{--</li>--}}
  {{--<li role="presentation" class="{{ $isVerify == 1 ? 'active' : '' }}"><a href="{{ action('PlatformController@activityManager', 1) }}">已审核</a></li>--}}
  {{--<li role="presentation" class="{{ $isVerify == 0 && $isVerify != null ? 'active' : '' }}"><a href="{{ action('PlatformController@activityManager', 0) }}">未审核</a></li>--}}
{{--</ul>--}}
    <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>
                <div class="checkbox checkbox-material-amber">
                <label>
                  <input type="checkbox" class="list-check" id="checkall">
                </label>
                </div>
            </th>
            <th>活动名称</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>报名人数</th>
            <th>活动地点</th>
            <th>审核</th>
        </tr>
        </thead>
        <tbody>
        @if(count($activityManager))
        @foreach($activityManager as $at)
        <tr>
            <td>
                <div class="checkbox checkbox-material-amber">
                <label>
                  <input type="checkbox" class="list-check" id="{{ $at->id }}">
                </label>
                </div>
            </td>
            <td>
            {{ $at->title }}
            </td>
            <td>
            {{ $at->content }}
            </td>
            <td>
            {{ $at->start_time }}
            </td>
            <td>
            {{ $at->request_num }}
            </td>
            <td>
            {{ $at->area }}
            </td>
            <td>
                {{--<input type="checkbox" id="{{ $at->id }}" {{ $at->is_verify == 1 ? 'checked' : '' }}  name="verify"/>--}}
                <div class="togglebutton togglebutton-material-amber">
                    <label>
                      <input type="checkbox" id="{{ $at->id }}" {{ $at->is_verify == 1 ? 'checked' : '' }}  name="verify">
                    </label>
                 </div>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="page-container">
    {{ $activityManager->links() }}
    </nav>
    <div class="control-pannel" style="">
        <a href="javascript:void(null);" class="btn btn-material-amber" id="approve-btn">
            <i class="fa fa-check"></i>
            &nbsp;
            审核选中
        </a>
        <a href="javascript:void(null);" class="btn btn-default" id="reject-btn">
            <i class="fa fa-close"></i>
            &nbsp;
            否决选中
        </a>
    </div>
</div>

@section('scripts')
{{ HTML::script('/scripts/bootstrap-switch.min.js') }}
<script type="text/javascript">

function setCheckedState(ids, state) {
    var _i = 0;
    var _len = ids.length;
    var _$checkedItems = $('.list-check:checked');
    for(; _i < _len; _i++) {
        $(_$checkedItems[_i])
            .parents('tr')
            .find('input[name=verify]')
            .attr('checked' ,state);
    }
    $('.list-check:checked').eq(0).parents('tr').find('input[name=verify]')
//    $('input[name="my-checkbox"]').bootstrapSwitch('state', true, true);
}

function initBatch() {
    var isAllcheck = false;
    var selectedArr = [];

    $('.list-check').on('click',function(e) {
        var $checkbox = $('.table-list tr td:first-child .list-check')
        if($(e.target).attr('id') == 'checkall') {
            if(isAllcheck == false)  $checkbox.prop('checked',true);
            else $checkbox.removeAttr('checked');
            isAllcheck = !isAllcheck;
        }
//        if($('.table-list tr td:first-child .list-check:checked').length)  $('.control-pannel').show();
//        else  $('.control-pannel').hide();
    });
}

function getSelectedData() {
    var ret = [];
    var checked = $('.table-list tr td:first-child .list-check:checked');
    var i = 0;
    if(!checked.length) {
        alert('请选择');
        return false;
    }
    for(; i < checked.length; i++) {
        ret.push(parseInt($(checked[i]).attr('id')));
    }
    return ret;
}



function confirmToUpdateStatus() {
    $('input[name=verify]').on('click', function(event) {
        var _type = $(this).attr('checked') == "checked" ? 0 : 1;
        var _ids = [parseInt($(this).attr('id'))];
        $.post('{{ route('verifyat') }}',{ type: _type, ids: _ids })
         .success(function(data) {
            alert(data.message);
            setCheckedState(_ids,_type == 1 ? true : false);
         })
         .error(function() {

         })

    });
    $('#approve-btn,#reject-btn').on('click', function() {
        var _ids = getSelectedData();
        var _type = $(this).attr('id') == 'approve-btn' ? 1 : 0;
        $.post('{{ route('verifyat') }}',{ type: _type, ids: _ids })
         .success(function(data) {
            alert(data.message);
            setCheckedState(_ids,_type == 1 ? true : false);
         })
         .error(function() {

         })
    });
}

function initCheckbox() {
    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'success';
    $.fn.bootstrapSwitch.defaults.onText = '通过';
    $.fn.bootstrapSwitch.defaults.offText = '否决';
    $("[name='verify']").bootstrapSwitch();
}

function initCheckboxClick() {
    $('.chk-filter ').on('click', function(e) {
        var url = $(this).find('input[type=checkbox]').attr('url');
        location.href = url;
    });
}

$(function() {
    initCheckboxClick();
//    initCheckbox();
    initBatch();
    confirmToUpdateStatus();
})
</script>
@endsection