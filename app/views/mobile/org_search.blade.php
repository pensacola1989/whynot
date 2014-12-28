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
            <input type="text" placeholder="组织名称">
            <a href="#" class="ui-icon-close"></a>
        </div>
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <label for="#">类型:</label>
            <select name="type" id="">
                <option value="">不限</option>
                <option value="">d</option>
                <option value="">d</option>
            </select>
        </div>
    </form>
</div>

<ul class="ui-list ui-list-text ui-list-link ui-border-tb">
    <li class="ui-border-t">
        <p>爱心社</p>
    </li>
    <li class="ui-border-t">
        <p>基金会</p>
    </li>

</ul>