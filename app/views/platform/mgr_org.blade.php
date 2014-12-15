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
        管理组织
        <small>平台方管理组织</small>
    </h2>
    <div class="row org_des">
        <div class="col-md-4 org_des_item">
            <i class="fa fa-line-chart"></i>
            &nbsp;
            总组织数:
            <a href="#"><span class="badge">{{ $totalCount }}</span></a>
        </div>
        <div class="col-md-4 org_des_item">
            <i class="fa fa-check"></i>
            &nbsp;
            已审核数:
            <a href="#"><span class="badge">{{ $verifyCount }}</span></a>
        </div>
        <div class="col-md-4 org_des_item">
            <i class="fa fa-exclamation-triangle"></i>
            &nbsp;
            未审核数:
            <a href="#"><span class="badge">{{ $totalCount - $verifyCount }}</span></a>
        </div>
    </div>
</div>
<div class="container">
<ul class="nav nav-pills">
<li><label>筛选条件：</label></li>
  <li role="presentation" class="{{ $isVerify == null ? 'active' : '' }}">
    <a href="{{ action('PlatformController@orgmanager') }}">无</a>
    </li>
  <li role="presentation" class="{{ $isVerify == 1 ? 'active' : '' }}"><a href="{{ action('PlatformController@orgmanager', 1) }}">已审核</a></li>
  <li role="presentation" class="{{ $isVerify == 0 && $isVerify != null ? 'active' : '' }}"><a href="{{ action('PlatformController@orgmanager', 0) }}">未审核</a></li>
</ul>
    <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>
                <label>
                  <input type="checkbox" class="list-check" id="checkall">
                </label>
            </th>
            <th>组织名称</th>
            <th>行业性质</th>
            <th>地区</th>
            <th>电话</th>
            <th>管理人员</th>
            <th>审核</th>
        </tr>
        </thead>
        <tbody>
        @if(count($Orgs))
        @foreach($Orgs as $o)
        <tr>
            <td>
                <label>
                  <input type="checkbox" class="list-check" id="{{ $o->id }}">
                </label>
            </td>
            <td>
            {{ $o->userinfos ? $o->userinfos->u_username : '' }}
            </td>
            <td>
            {{ $o->userinfos ? $o->userinfos->u_cp_unit : '' }}
            </td>
            <td>
            {{ $o->userinfos ? $o->userinfos->u_target_area : '' }}
            </td>
            <td>
            {{ $o->userinfos ? $o->userinfos->u_mobile : '' }}
            </td>
            <td>
            {{ $o->Admins->first() ? $o->Admins->first()->Volunteer['volunteer_name'] : 0 }}
            </td>
            <td>
            <input type="checkbox" id="{{ $o->id }}" {{ $o->is_verify == 1 ? 'checked' : '' }} name="verify"/>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="page-container">
        {{ $Orgs->links() }}
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
        $.post('{{ route('verifyorg') }}',{ type: _type, ids: _ids })
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