@section('styles')
<style type="text/css">
/*.modify-time.hide {display: none;}*/
</style>
@endsection
<div class="page-header">
    <h2>
        志愿者评价
    </h2>
</div>
<div class="container">
    <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>活动时间</th>
            <th>参与评价</th>
        </tr>
        </thead>
        <tbody>
        @if(count($attendWithPivot))
        @foreach($attendWithPivot as $attendee)
        <tr>
            <td>{{ $attendee->volunteer_name }}</td>
            <td>{{ $attendee->volunteer_mobile }}</td>
            <td>{{ $attendee->volunteer_email }}</td>
            <td>
                <span>{{ 10 }}</span>
                &nbsp;&nbsp;
                <a class="modify-time" id="{{ $attendee->id }}" href="javascript:void(null)">
                    <i class="fa fa-pencil"></i>
                    修改
                </a>
            </td>
            <td></td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-pencil"></i>
            &nbsp;
            志愿者时间修改
        </h4>
      </div>
      <div class="modal-body">
        <label class="col-sm-5 control-label">请输入志愿者实际用时</label>
        <div class="input-group" style="width:150px;">
            <input type="text"  class="form-control" id="time-value"/>
            <span class="input-group-addon">小时</span>
        </div>
            <p class="bg-danger" id="modal-error" style="display: none;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
        <button type="button" id="submit-btn" class="btn btn-success" data-id="">
            <i class="fa fa-check"></i>
            修改时间
        </button>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">
function showModifyDailog() {

}
$(function() {
    $('#submit-btn').on('click', function() {

        var _error = '';
        var _isError = false;
        var _value = $('#time-value').val();

        if(_value == '') {
            _isError = true;
            _error = '请输入修改时间!';
        }
        else if(!(/^[0-9]*$/.test(_value))) {
            _isError = true;
            _error = '请输入数字!';
        }
        if(_isError) {
            $('#modal-error').html(_error).show();
            return false;
        }
        // make ajax call
    });
    $('table tbody>tr').hover(function() {
//        $(this).find('a.modify-time').toggleClass('hide');
    });
    $('.modify-time').on('click', function() {
        $('#modal-error').hide();
        $('#myModal').find('#submit-btn').attr('id',$(this).attr('id'));
        $('#myModal').modal();
    });
});
</script>
@endsection