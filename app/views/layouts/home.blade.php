<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    {{ HTML::style('/styles/global.css') }}
    {{ HTML::style('/styles/register.css')  }}
    {{ HTML::style('/styles/tree.css') }}
    @yield('styles')
</head>
<body>

<div class="wrapper">
	 <div class="navbar navbar-fixed-top mynav" role="navigation">
      <div class="pull-left">
        <div class="navbar-header">
          <a class="myhover navbar-brand" href="#">
            <img id="logo" src="{{ URL::asset('images/home/hagongyi-3.png') }}">
          </a>
          @if(Auth::check())
          <a href="javascript:void(null);" id="toggleBar" style="float: left;" class="glyphicon glyphicon-align-justify"></a>
          @endif
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          {{--@if(!Auth::check())--}}
            <li class="{{--$data['currentPage'] == 'register' ? 'active' : ''--}} myli wc">{{--HTML::link('/register','注册')--}}</li>
            <li class="{{--$data['currentPage'] == 'userLogin' ? 'active' : ''--}} myli wc">{{--HTML::link('/login','登录')--}}</li>
          {{--@else--}}
            <span></span>
          {{--@endif--}}
            <!-- <li class="myli wc"><a href=""></a></li> -->
            <!-- <li><a href="#about">Register</a></li> -->
          </ul>



        </div>

        </div><!--/.nav-collapse -->
        @if(Auth::check())
        <ul class="nav navbar-nav navbar-right" style="float:right;">
            {{--@if(Auth::user()->can('manage_platform')))--}}
              {{--<li>--}}
                {{--<a href="#" class="" data-toggle="tooltip" data-placement="top" title="用户系统管理">--}}
                  {{--<i class="fa fa-user" style="margin-right:5px;"></i>--}}
                  {{--&nbsp;平台用户管理--}}
                {{--</a>--}}
              {{--</li>--}}
              {{--@endif--}}
              <li>
                <a href="{{ url('user/logout') }}" class="" >
                  <span class="glyphicon glyphicon-off" style="margin-right:5px;color:#ea6153;"></span>
                </a>                
              </li>
              <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog" style="margin-right:10px;"></span>
                  {{--<span href="javascript:void(null);">{{ Auth::user()->username }}</span>--}}
                </a>

                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <!-- <li><a href="#" id="logout">注销</a></li> -->
                  <li>{{ HTML::link('user/logout','注销',array('id'=>'logout')) }}</li>
                </ul>
              </li>
              <li>

              </li>
          </ul>
        @endif
      </div>
    </div>
    @if(Auth::check())
    <div class="tree_bar">
       <ul class="tree_container">
        <li id="mod_org_card" class="tree_item open">
          <a><i class="glyphicon glyphicon-phone"></i>组织名片</a>
          <ul class="tree_child">
            <li class="child_item">{{ HTML::link('＃','名片版式') }}</li>
            <li class="child_item">{{ HTML::link('/wechatMenu/index','菜单设置') }}</li>
            <li class="child_item">{{ HTML::link('＃','细节设置') }}</li>
            <!-- <li class="child_item"><a>分类页面</a></li> -->

          </ul>
        </li>
        <li id="mod_setting" class="tree_item"><a><i class="glyphicon glyphicon-user"></i>设置</a>
          <ul class="tree_child">
            <li class="child_item">{{ HTML::link('/channel/index','互联网渠道设置') }}</li>
            <li class="child_item">{{ HTML::link('＃','组织邀请') }}</li>
          </ul>
        </li>
        @if(Auth::user()->Orgs()->first()->can('manage_platform'))
         <li id="mod_platform" class="tree_item"><a><i class="glyphicon glyphicon-user"></i>平台管理</a>
          <ul class="tree_child">
            <li class="child_item">{{ HTML::link('/pfmanager/activity','活动审核') }}</li>
            <li class="child_item">{{ HTML::link('/pfmanager/org','组织审核') }}</li>
          </ul>
        </li>
        @endif
        <li id="mod_volunteer" class="tree_item"><a><i class="glyphicon glyphicon-user"></i>志愿者</a>
          <ul class="tree_child">
            <li class="child_item">{{ HTML::link('/volteer_s','志愿者查找') }}</li>
            <li class="child_item">{{ HTML::link('/volgroup','组别设置') }}</li>
            <li class="child_item">{{ HTML::link('/volteer/info','信息设置') }}</li>
          </ul>
        </li>
        <li id="mod_activity" class="tree_item"><a><i class="glyphicon glyphicon-heart"></i>活动</a>
          <ul class="tree_child">
            <li class="child_item">{{ HTML::link('/activity/publish','活动发布') }}</li>
            <li class="child_item">{{ HTML::link('/activity/manage','活动管理') }}</li>
            <li class="child_item">{{ HTML::link('/activity/summary','活动总结') }}</li>
          </ul>
        </li>

      </ul>
    </div>
    @endif
    <div class="frame_container">
        <div class="content_container">
            {{ $content }}
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
{{ HTML::script('http://libs.baidu.com/jquery/2.0.0/jquery.js') }}
{{ HTML::script('scripts/jquery-cookie.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}
{{ HTML::script('scripts/bootbox.min.js') }}
{{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js') }}
{{ HTML::script('scripts/plupload.js')}}
{{ HTML::script('scripts/tree.js') }}
{{ HTML::script('scripts/layout.js') }}
<script type="text/javascript">
var COOKIE_MOD_KEY = 'current_mod_name';
var COOKIE_MOD_CHILD_INDEX_KEY = 'current_mod_child_index';

function setTreeStatus(modName, index) {
//    $.removeCookie(COOKIE_MOD_KEY,{ path: '/' });
//    $.removeCookie(COOKIE_MOD_CHILD_INDEX_KEY,{ path: '/' });
    $.cookie(COOKIE_MOD_KEY, modName, { path: '/' });
    $.cookie(COOKIE_MOD_CHILD_INDEX_KEY, index, { path: '/' });
}

function initTreeStatus() {
    var _currentMod = $.cookie()[COOKIE_MOD_KEY];
    var _currentModIndex = $.cookie()[COOKIE_MOD_CHILD_INDEX_KEY];

    $('.tree_item').removeClass('open');
    $('#' + _currentMod).addClass('open');
    $('#' + _currentMod + '> ul').addClass('active').slideDown();
    $('#' + _currentMod + '> ul').find('li').eq(_currentModIndex).addClass('current');
}

$(function() {
    $.cookie.path = '/';
    initTreeStatus();
    $('[data-toggle="tooltip"]').tooltip();
    $('.child_item').on('click', function(e) {
        e.preventDefault();
        var _id = $(this).parents('li.tree_item').attr('id');
        var _index = $(this).index();
        setTreeStatus(_id, _index);
        window.location.href = $(this).find('a').attr('href');
    });
});
</script>
@yield('scripts')
</body>
</html>
