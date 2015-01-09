@section('styles')
<style type="text/css">
select{
width:100%;height:30px;margin-left: 50px;
}
</style>
@endsection

<div class="ui-form ui-border-t">
    <form action="#" >
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input name="orgName" type="text" placeholder="组织名称">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <label for="#">类型:</label>
            <select name="orgType" id="orgType">
                <option value="0">不限</option>
                <option value="教育">教育</option>
                <option value="社工">社工</option>
            </select>
        </div>
        <div id="ret-content">
        {{--<ul class="ui-list ui-list-text ui-list-link ui-border-tb">--}}
            {{--<li class="ui-border-t">--}}
                {{--<a href="">--}}
                    {{--<p>爱心社</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="ui-border-t">--}}
                {{--<p>基金会</p>--}}
            {{--</li>--}}
        {{--</ul>--}}
        </div>
        <div class="ui-btn-wrap">
            <button id="search-btn" class="ui-btn-lg ui-btn-primary">
                <i class="fa fa-search"></i>
                &nbsp;&nbsp;
                搜索组织
            </button>
        </div>
    </form>
</div>
@section('scripts')
<script type="text/javascript">
var $el;
var tpl = [
        '<ul class="ui-list ui-list-text ui-list-link ui-border-tb">',
        '<% for(var i = 0; i < data.length; i++ ) {%>',
        '<li uid="<%=data[i].uid%>" class="ui-border-t link-org">',
        '    <p><%=data[i].u_username%></p>',
        '</li>',
        '<% } %>',
        '</ul>'
].join('');

function searchOrg($orgName, $orgType) {
   $.post('{{ URL::route('org_search') }}', {
        'org_name': $orgName,
        'org_type': $orgType
   }, function(data) {
        if(data && data.length) {
            var html = $.tpl(tpl,{ data: data});
            $el.hide();
            $('#ret-content').html(html);
            bindEvent();
        }
   });
}

function bindEvent() {
   $('.link-org').on('tap', function() {
        var targetOrgId = $(this).attr('uid');
        var url = '/mobile/home/' + targetOrgId;
        window.location.href = url;
   });
}


!function($) {
   $('#search-btn').on('tap', function(e) {
        $el = $.loading({
            content:'正在搜索...'
        });
        var _orgName = $('input[name=orgName]').val();
        var select = document.getElementById('orgType');
        var _selType = select.options[select.selectedIndex].value;
        if(parseInt(_selType) == 0)
            _selType = '';
        searchOrg(_orgName, _selType);
   });


} (Zepto)
</script>
@endsection

