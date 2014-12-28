@section('styles')
<style type="text/css">
.hgy-mobile-header{background-color: #EFEFEF;width:100%;}
</style>
@endsection
<h2 class="hgy-mobile-header">
    <div class="ui-avatar-one">
        <span style="background-image:url(http://icase.tencent.com/vlabs/img/?128*128)"></span>
    </div>
    <span>哈公益</span>
</h2>

<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">姓名/昵称：</label>
            <input type="text" placeholder="姓名/昵称">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">邮箱：</label>
            <input type="text" placeholder="邮箱">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-l ui-border-b">
                <label class="ui-border-r">爱好：</label>
                <input type="text" placeholder="逗号分割">
                <a href="#" class="ui-icon-close"></a>
            </div>
        <div class="ui-btn-wrap">
            <button class="ui-btn-lg ui-btn-danger">确定</button>
        </div>
    </form>
</div>