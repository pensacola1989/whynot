{{ HTML::style('/styles/activity.css') }}
<div class="container">
<div class="page-header">
    <h2>活动发布</h2>
</div>
<div class="container public-info activate">
<form method="GET" action="" class="activity-form" role="form">
  {{--<span>快速查询</span>--}}
  <div class="form-group">
    <div class="input-group">
      <label>活动名称</label>
      <input type="text" class="form-control" name="activity" id="activity" placeholder="活动">
    </div>
    <div class="input-group">
      <label>活动图标</label>
      <img src="{{URL::asset('/images/home/logo-max.png')}}" height="60px">
    </div>
    <div class="input-group">
      <label>活动时间</label>
      <input type="text" class="form-control" name="activity" id="activity" placeholder="开始时间" style="width:200px;margin-left:-15px">
      &nbsp;至&nbsp;
      <input type="text" class="form-control" name="activity" id="activity" placeholder="结束时间" style="width:200px">
    </div>
    <div class="input-group">
        <label>活动地点</label>
      <input type="text" class="form-control" name="activity" id="activity" placeholder="活动地点">
    </div>
    <div class="input-group">
        <label>活动内容</label>
      <textarea type="text" class="form-control" name="activity" id="activity" placeholder="活动内容"></textarea>
    </div>
  </div>
    <a class="btn btn-primary public_next" href="#" role="button">下一步</a>
</form>
</div>

<div class="container public-info hidden">
    <div class="info-list">
        <div class="list-group-item">
            <label>活动地点</label>
            <input type="text" class="form-control" name="activity" id="activity" placeholder="活动地点">
              <input type="checkbox">必填
              <a class="btn btn-primary" href="#" role="button">上移</a>
              <a class="btn btn-primary" href="#" role="button">下移</a>
        </div>
        <div class="list-group-item">
            <label>手机</label>
            <input type="text" class="form-control" name="activity" id="activity" placeholder="手机">
            <input type="checkbox">必填
              <a class="btn btn-primary" href="#" role="button">上移</a>
              <a class="btn btn-primary" href="#" role="button">下移</a>
        </div>
        <div class="list-group-item">
            <label>邮箱</label>
            <input type="text" class="form-control" name="activity" id="activity" placeholder="邮箱">
            <input type="checkbox">必填
              <a class="btn btn-primary" href="#" role="button">上移</a>
              <a class="btn btn-primary" href="#" role="button">下移</a>
        </div>
        <a class="btn btn-primary" id="add_info" href="#" role="button">添加</a>
    </div>
    <a class="btn btn-primary public_next" href="#" role="button">下一步</a>
</div>

<div class="container public-info hidden">

    <a class="btn btn-primary" href="#" role="button">发布</a>
    <a class="btn btn-primary" href="#" role="button">保存</a>
</div>
</div>

@section('scripts')
<script type="text/javascript">
function nextPage() {
    $('.public_next').bind("click",function(){
        var page = $(".public-info")
        page.each(function(){
            if($(this).hasClass("activate")){
                $(this).removeClass("activate").addClass("hidden")
                $(this).next().removeClass("hidden").addClass("activate");
                return false;
            }
        });
    });
}
function initPublic(){
    nextPage();
}
$(function() {
    initPublic();
});

</script>
@stop