<div class="page-header">
    <h2>
        SNS平台配置
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>NS AppKey配置，不断增加中</small>
    </h2>
</div>
<div class="container">
<form class="form-horizontal"
    method="post"
    action="{{ URL::action('ChannelController@postEditOthers') }}">
  <div class="form-group form-group-material-amber-600">
    <label for="weibo" class="col-sm-2 control-label">新浪微博</label>
    <div class="col-sm-10">
      <input value="{{ $snsKeyInfo ? $snsKeyInfo->tsina : '' }}" name="tsina" type="text" class="form-control" id="weibo" placeholder="Appkey">
    </div>
  </div>
  <div class="form-group form-group-material-amber-600">
      <label for="tencent-weibo" class="col-sm-2 control-label">腾讯微博</label>
      <div class="col-sm-10">
        <input value="{{ $snsKeyInfo ? $snsKeyInfo->tqq : '' }}" name="tqq" type="text" class="form-control" id="tencent-weibo" placeholder="Appkey">
      </div>
    </div>
  <div class="form-group form-group-material-amber-600">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-material-amber">
        <i class="fa fa-check"></i>
        &nbsp;
        保存
      </button>
      <button onclick="javascript:history.go(-1);" type="submit" class="btn btn-default">
          <i class="fa fa-arrow-left"></i>
          &nbsp;
          返回
      </button>
    </div>
  </div>
</form>

</div>