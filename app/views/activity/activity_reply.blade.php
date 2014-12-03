@section('styles')
<style type="text/css">
/*.modify-time.hide {display: none;}*/
.comment-content {
    position: relative;
    color: #FFF;
    padding: 5px;
    border-radius: 5px;
    margin:5px;
}
.vol-row .comment-content {
    background-color: #2980B9;
}
.at-row .comment-content {
    background-color: #DDD;
    color:#333;
}
.arrow.arrow-left {
    position: absolute;
    display: block;
    height: 0;
    left: -10px;
    top: 5px;
    width: 0;
    /* border-color: #000; */
    border:5px solid transparent;
    border-right: 5px solid #2980B9;
}

.arrow.arrow-right {
    position: absolute;
    display: block;
    height: 0;
    left: -10px;
    top: 5px;
    width: 0;
    /* border-color: #000; */
    border:5px solid transparent;
    border-right: 5px solid #ddd;
}
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
            <th>参与者评价</th>
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
                <span>{{ $attendee->pivot->vol_duration ? $attendee->pivot->vol_duration : 10}}</span>
                &nbsp;&nbsp;
                <a class="modify-time" id="{{ $attendee->id }}" href="javascript:void(null)"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="修改">
                    <i class="fa fa-pencil"></i>
                </a>
            </td>
            <td>
                <a id="{{ $attendee->id }}" data-vol_reply="{{ $attendee->pivot->vol_reply }}"
                    data-at_reply="{{ $attendee->pivot->at_reply }}"
                    class="check-reply" href="javascript:void(null);" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                    <i class="fa fa-eye"></i>
                </a>

            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="pager-container">

      {{ $attendWithPivot->links() }}
    </nav>
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

<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-pencil"></i>
            &nbsp;
            志愿者评价
        </h4>
      </div>
      <div class="modal-body">
          <div class="row vol-row">
            <div class="col-sm-3">志愿者：</div>
            <div class="col-sm-6 comment-content">
                活动办的不错
                <span class="arrow arrow-left"></span>
            </div>
          </div>
          <div class="row at-row">
              <div class="col-sm-3">活动方：</div>
              <div class="col-sm-6 comment-content">
                谢谢鼓励
                <span class="arrow arrow-right"></span>
              </div>
          </div>
          <div class="row reply-box">
              <div class="col-sm-3">回复内容：</div>
              <div class="col-sm-6">
                <textarea name="at-reply" id="reply-content" cols="30" rows="5"></textarea>
              </div>
          </div>
          <p class="bg-danger" id="modal-error" style="display: none;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
        <button type="button" id="reply-btn" class="btn btn-success" data-id="">
            <i class="fa fa-check"></i>
            回复
        </button>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">
var $current;
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('.check-reply').on('click',function() {
        $current = $(this);

        $('#replyModal').find('#reply-btn').attr('vol_id',$(this).attr('id'));
        var vol_reply = $(this).data('vol_reply');
        var at_reply = $(this).data('at_reply');
        if(vol_reply != '') {
            $('.vol-row').find('.comment-content').html(vol_reply);
        }

        if(at_reply != '')  {
            $('.at-row').show();
            $('.at-row').find('.comment-content').html(at_reply);
            $('.reply-box').hide();
            $('#reply-btn').hide();
        }
        else {
            $('.at-row').hide()
            $('.reply-box').show();
            $('#reply-btn').show();
        }


        $('#replyModal').modal();
    });
    $('#reply-btn').on('click', function() {
//        $('#reply-content').val('');
        $(this).attr('disabled');
        $('#modal-error').hide();
        var _id = parseInt($(this).attr('vol_id'));
        var _value = $('#reply-content').val();
        var _error = '';
        var _isError = false;

        if(_value == '') {
            _isError = true;
            _error = '请输入回复内容';
        }
        if(_isError) {
            $('#modal-error').html(_error).show();
            return false;
        }

        $.post('{{ route('replytovol', $activityId) }}', { volId: _id , at_reply: _value })
        .success(function(data) {
            if(!data.errorCode) {
                $('#replyModal').modal('hide');
                $current.data('at_reply',_value);
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .error(function() {

        })
        .done(function() {
            $('#reply-btn').removeAttr('disabled');
        })
    });
    $('#submit-btn').on('click', function() {
        var _id = parseInt($(this).attr('id'));
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
        $.post('{{ route('updateduration', $activityId) }}', { volId: _id , vol_duration: _value})
        .success(function(data) {
            if(!data.errorCode) {
                $('#myModal').modal('hide');
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .error(function() {

        });
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