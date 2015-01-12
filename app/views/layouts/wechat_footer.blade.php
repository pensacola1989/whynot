<div class="ui-btn-group ui-btn-group-bottom">
    <button class="nav-btn" id="orgHome" type="button" url="{{ URL::action('mobile\HomeController@index', $orgId ) }}">
       <i class="fa fa-bank"></i> 组织首页
    </button>
    <button class="nav-btn" type="button" url="{{ URL::action('mobile\WcActivityController@latest', $orgId) }}">
        <i class="fa fa-leaf"></i>
        活动
    </button>
    <button class="nav-btn" type="button" url="{{ URL::action('mobile\WcVltController@index', $orgId) }}">
        <i class="fa fa-user"></i>
        我的
    </button>
</div>