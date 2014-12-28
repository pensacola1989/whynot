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
        <small>平台方审核公益组织活动</small>
    </h2>
</div>
<div class="container">
<ul class="nav nav-pills">
<li><label>筛选条件：</label></li>
  <li role="presentation" class="{{ $isVerify == null ? 'active' : '' }}">
    <a href="{{ action('PlatformController@activityManager') }}">无</a>
    </li>
  <li role="presentation" class="{{ $isVerify == 1 ? 'active' : '' }}"><a href="{{ action('PlatformController@activityManager', 1) }}">已审核</a></li>
  <li role="presentation" class="{{ $isVerify == 0 && $isVerify != null ? 'active' : '' }}"><a href="{{ action('PlatformController@activityManager', 0) }}">未审核</a></li>
</ul>
    <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>
                <label>
                  <input type="checkbox" class="list-check" id="checkall">
                </label>
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
                <label>
                  <input type="checkbox" class="list-check" id="{{ $at->id }}">
                </label>
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
            <input type="checkbox" id="{{ $at->id }}" {{ $at->is_verify == 1 ? 'checked' : '' }}  name="verify"/>
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
        <a href="javascript:void(null);" class="btn btn-success" id="approve-btn">
            <i class="fa fa-check"></i>
            &nbsp;
            审核选中
        </a>
        <a href="javascript:void(null);" class="btn btn-danger" id="reject-btn">
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
            .bootstrapSwitch('state', state,1);
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
    $('input[name=verify]').on('switchChange.bootstrapSwitch', function(event, state) {
        var _type = state ? 1 : 0;
        postToUpdate(_type, [parseInt($(this).attr('id'))]);

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

$(function() {
    initCheckbox();
    initBatch();
    confirmToUpdateStatus();
})
</script>
@endsection