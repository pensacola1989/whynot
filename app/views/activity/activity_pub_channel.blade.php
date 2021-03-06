@section('styles')
<style type="text/css">
.sns-btn a{font-size: 40px; margin-left:10px;}
</style>
@endsection
<div class="page-header">
     <h2>
        渠道发布
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>签到二维码，SNS</small>
    </h2>
</div>
<div class="container">
    <div class="row">
      <div class="col-md-3">签到二维码</div>
      <div class="col-md-4">
        <img src="{{ $getQrImgUrl }}" alt=""/>
      </div>
    </div>
    @if(!$isActivityVerified)
      <div class="col-md-3">分享到SNS</div>
          <div class="col-md-4">
          <p>请等待审核</p>
          </div>
      </div>
    @endif
    @if($isActivityVerified)
    <div class="row">
      <div class="col-md-3">分享到SNS</div>
      <div class="sns-btn col-md-4">
        <!-- JiaThis Button BEGIN -->
       <a class="jiathis_button_tsina" style="color:#D32F2F;" data-toggle="tooltip" data-placement="bottom" title="分享到sina微博">
        <i class="fa fa-weibo"></i>
       </a>
       <a class="jiathis_button_qzone" style="color:#03A9F4;" data-toggle="tooltip" data-placement="bottom" title="分享到QQ空间">
        <i class="fa fa-qq"></i>
       </a>
       <a class="jiathis_button_renren" style="color:#0288D1;" data-toggle="tooltip" data-placement="bottom" title="分享到人人网">
        <i class="fa fa-renren"></i>
       </a>
       <a class="jiathis_button_tqq" style="color:#B3E5FC;" data-toggle="tooltip" data-placement="bottom" title="分享到腾讯微博">
        <i class="fa fa-tencent-weibo"></i>
       </a>
       <a class="jiathis_button_weixin" href="#">
        <i class="fa fa-weixin" style="color:#04be02;"></i>
       </a>
       </div>

        {{--<div id="ckepop">--}}
           {{--<span class="jiathis_txt">分享到：</span>--}}
             {{--<a class="jiathis_button_weixin">微信</a>--}}
                {{--<a class="jiathis_counter_style"></a> </div>--}}
               {{--</div>--}}
        <!-- JiaThis Button END -->
      </div>
      @endif
    </div>

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-4">
        {{--<button id="{{ $activityId }}" {{ $isPublished ? 'disabled' : ''}} class="publish-btn btn btn-success">--}}
            {{--<i class="fa fa-send"></i>--}}
            {{--&nbsp;--}}
            {{--{{ $isPublished ? '已发布到哈公益' : '发布到哈公益' }}--}}

        {{--</button>--}}
      </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript">
var jiathis_config = {
    boldNum:0,
    siteNum:7,
    showClose:false,
    sm:"t163,kaixin001,renren,douban,tsina,tqq,tsohu",
    imageUrl:"http://v2.jiathis.com/code/images/r5.gif",
    imageWidth:26,
    marginTop:150,
    url:"",
    title:"自定义TITLE #微博话题#",
    summary:"分享的文本摘要",
    pic:"自定义分享的图片连接地址",
    data_track_clickback:true,
    appkey:{
        "tsina":"{{ $snsKeyInfo->tsina }}",
        "tqq":" {{ $snsKeyInfo->tqq }}",
        "tpeople":"您网站的人民微博APPKEY"
    },
    ralateuid:{
        "tsina":"您的新浪微博UID"
    },
    "shortUrl":'',
    evt:{
        'share': 'testShare'
    }
}
function testShare(e) {
    return false;
}
$(document).ready(function() {
    $('.sns-btn a').on('click', function(e) {
        e.preventDefault();
    });
    $('.publish-btn').on('click', function() {
        var _id = parseInt($(this).attr('id'));
        publish(_id);
    });
});

function publish($activityId) {
    $.post('{{ route('atpub') }}', { activityId: $activityId })
    .success(function(data) {
        if(!data.errorCode) {
            alert(data.message);
            history.go(0);
        }
    })
    .error();
}
</script>
<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
@endsection