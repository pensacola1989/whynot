@section('styles')
{{ HTML::style('/styles/bootstrap-switch.min.css') }}
@endsection
<div class="page-header">
    <h2>
        审核报名
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>审核已经报名的志愿者</small>
    </h2>
</div>
<div class="container">
    <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>
                <label>
                  <input type="checkbox" class="list-check" id="checkall">
                </label>
            </th>
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>详细信息</th>
            <th>审核</th>
        </tr>
        </thead>
        <tbody>
        @if(count($registers))
        @foreach($registers as $reg)
        <tr>
            <td>
              <label>
                <input id="{{ $reg->id }}" type="checkbox" class="list-check"/>
              </label>
            </td>
            <td>{{ $reg->volunteer_name }}</td>
            <td>{{ $reg->volunteer_mobile }}</td>
            <td>{{ $reg->volunteer_email }}</td>
            <td>
            </td>
            <td>
                <input type="checkbox" id="{{ $reg->id }}" {{ $reg->pivot->is_verify == 1 ? 'checked' : '' }} name="verify"/>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="pager-container">

        {{ $registers->links() }}
    </nav>
    <div class="control-pannel" style="display: none;">
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
        if($('.table-list tr td:first-child .list-check:checked').length)  $('.control-pannel').show();
        else  $('.control-pannel').hide();
    });
}

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

function postToUpdate(type,ids) {
    $.post('{{ route('approve', $activityId)  }}',{ type: type, ids: ids })
     .success(function(data) {
        alert(data.message);
        setCheckedState(ids, type == 1 ? true : false);
     })
     .error(function() {

     })
}

function confirmToUpdateStatus() {
    $('input[name=verify]').on('switchChange.bootstrapSwitch', function(event, state) {
        var _type = state ? 1 : 0;
        postToUpdate(_type, [parseInt($(this).attr('id'))]);

    });
    $('#approve-btn,#reject-btn').on('click', function() {
        var _ids = getSelectedData();
        var _type = $(this).attr('id') == 'approve-btn' ? 1 : 0;
        $.post('{{ route('approve', $activityId)  }}',{ type: _type, ids: _ids })
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