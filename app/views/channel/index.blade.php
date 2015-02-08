<div class="page-header">
    <h2>
        渠道管理
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>配置微信接口</small>
    </h2>
</div>
<div class="container">
<form method="POST" action="{{ $WechatChannel != null ? URL::action('ChannelController@postChannelEdit', $WechatChannel->id) : URL::action('ChannelController@postChannelEdit') }}" accept-charset="UTF-8" class="hgy-form form-horizontal" role="form">
  <div class="form-group">
    <label for="token" style="text-align:right;" class="col-sm-2 control-label">接口地址</label>
    <div class="col-sm-10">
    {{ $interfaceInfos['callback_url'] }}
    </div>
  </div>
  <div class="form-group">
      <label for="token" style="text-align:right;" class="col-sm-2 control-label">接口token</label>
      <div class="col-sm-10">
      {{ $interfaceInfos['token']}}
      </div>
    </div>
  <div class="form-group form-group-material-amber-600">
    <label for="token" style="text-align:right;" class="col-sm-2 control-label">微信token</label>
    <div class="col-sm-10">
    <input class="form-control" id="token" placeholder="" name="token" type="text" value="{{ $WechatChannel != null ? $WechatChannel->token : '' }}">
    </div>
  </div>
  <div class="form-group form-group-material-amber-600">
      <label for="appid" style="text-align:right;" class="col-sm-2 control-label">appid</label>
      <div class="col-sm-10">
      <input class="form-control" id="appid" placeholder="" name="appid" type="text" value="{{ $WechatChannel != null ? $WechatChannel->appid : '' }}">
      </div>
    </div>
    <div class="form-group form-group-material-amber-600">
      <label for="appsecret" style="text-align:right;" class="col-sm-2 control-label">appsecret</label>
      <div class="col-sm-10">
      <input class="form-control" id="appsecret" placeholder="" name="appsecret" type="text" value="{{ $WechatChannel != null ? $WechatChannel->appsecret : '' }}">
      </div>
    </div>
    <div class="form-group form-group-material-amber-600">
    <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-material-amber">
          <i class="hgy-icon glyphicon glyphicon-ok"></i>
          更新
        </button>
              <p style="color:red;"></p>
      </div>
    </div>
</form>

</div>