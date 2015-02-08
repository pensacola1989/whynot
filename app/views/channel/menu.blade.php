@section('styles')
<style type="text/css">
.menu-container{width:300px;}
.menu-ul{}
.menu-ul li{
    background-color:#009688;
    color:#FFF;
    padding: 5px;
    margin: 10px;
}
.sub-li{color:#FFF;background-color: #B2DFDB !important;}
</style>
@endsection
<div class="page-header">
     <h2>
        微信自定义菜单配置
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;
        <small>配置微信自定义菜单</small>
    </h2>
</div>
<div class="container" ng-app="page" ng-controller="myCtrl">
<div class="menu-container">
    <ul class="menu-ul">
        <li ng-repeat="m in menu.button">
            <p ng-show="<%!m.sub_button%>">
                <%m.name%>
                <div class="help-block">
                    <%(m.type=='view') ? m.url : m.type%>
                </div>
            </p>
            <p ng-show="<%m.sub_button%>">
                <%m.name%>
                <ul class="sub-ul">
                    <li class="sub-li" ng-repeat="s in m.sub_button">
                        <%s.name%>
                        <div class="help-block">
                            <%(s.type=='view') ? s.url : s.type%>
                        </div>
                    </li>
                </ul>
            </p>
        </li>
    </ul>
    {{--<ul class="menu-ul">--}}
        {{--<li class="menu-li">--}}
            {{--<p>parent1<div class="help-block">http://weibo.com</div></p>--}}
        {{--</li>--}}
        {{--<li class="menu-li">--}}
            {{--<p>parent2<div class="help-block">http://weibo.com</div></p>--}}
        {{--</li>--}}
        {{--<li class="menu-li">--}}
            {{--parent3--}}
            {{--<ul class="sub-ul">--}}
                {{--<li class="sub-li">child1</li>--}}
                {{--<li class="sub-li">child2</li>--}}
            {{--</ul>--}}
        {{--</li>--}}
    {{--</ul>--}}

    <button modal-btn class="btn btn-primary">
        <i class="fa fa-plus"></i>
        添加
    </button>
    <button ng-click="saveMenu()" class="btn btn-material-amber">
        <i class="fa fa-check"></i>
        保存
    </button>
    <button ng-click="generateMenu()" class="btn btn-danger">
        <i class="fa fa-list-ul"></i>
        生成菜单
    </button>
  {{--</div>--}}
</div>
<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">添加菜单</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="">菜单名：</label>
            <input type="text" class="form-control" id="menu-name" placeholder="请输入菜单名" ng-model="editModel.menuName">
          </div>
          <div class="form-group">
            <label for="menu-level">父级/子级</label>
            <select class="form-control" name="menu-level" id="menu-level" ng-model="editModel.menuLevel">
                <option value="">父级</option>
                <option value="sub_button">子级</option>
            </select>
            <select ng-model="editModel.parentName" class="form-control"
                    ng-show="editModel.menuLevel=='sub_button'"
                    ng-options="m.name for m in menu.button track by m.name"
                    ng-change="isSubChange()">
            </select>
          </div>
          <div class="form-group">
            <label for="">菜单类型</label>
            <select class="form-control" ng-model="editModel.menuType" name="menu-type" id="menu-type">
                <option value="view">链接</option>
                <option value="click">点击事件</option>
            </select>
            <p class="help-block">Example block-level help text here.</p>
          </div>
          <div class="form-group">
            <label for="">额外信息</label>
            <input ng-model="editModel.menuExtra" type="text" class="form-control" placeholder="额外信息"/>
            <p class="help-block">额外信息url或者key</p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" ng-click="submit()">确认</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

@section('scripts')
<script type="text/javascript" src="http://cdn.bootcss.com/angular.js/1.3.8/angular.min.js"></script>
<script type="text/javascript">
var button =  {
                  "button":[
                  {
                       "type":"click",
                       "name":"今日歌曲",
                       "key":"V1001_TODAY_MUSIC"
                   },
                   {
                        "name":"菜单",
                        "sub_button":[
//                        {
//                            "type":"view",
//                            "name":"搜索",
//                            "url":"http://www.soso.com/"
//                         },
//                         {
//                            "type":"view",
//                            "name":"视频",
//                            "url":"http://v.qq.com/"
//                         },
                         {
                            "type":"click",
                            "name":"赞一下我们",
                            "key":"V1001_GOOD"
                         }]
                    }]
              };
var PARENT_LIMIT = 3;
var SUB_LIMIT = 5;

var page = angular.module('page', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
page.factory('helper', function($http) {
    return {
        getParentByName: function(name) {
            if(typeof name == 'undefined'
                || name == ''
                || !scope.menu.button.length)
                return;
            var _targetObj;
            var _button = scope.menu.button;
            var _i = 0;
            var _len = _button.length;
            for(; _i < _len; _i++) {
                if(typeof _button[_i].sub_button != 'undefined'
                    && _button[_i].name == name) {
                    _targetObj = _button[_i];
                    break;
                }
            }
            return _targetObj;
        },
        saveMenu: function(menuData) {
            return $http.post('{{ URL::action('MenuController@postEditMenu') }}', menuData);
        },
        getMenu: function() {
            return $http.get('{{ URL::action('MenuController@getMenu')  }}');
        },
        generateMenu: function() {
            return $http.post('{{ URL::action('MenuController@generateMenu')  }}')
        }
    };
});
page.controller('myCtrl',function($scope, helper) {

    helper.getMenu()
            .success(function(data) {
                if(data) {
                    data = JSON.parse(data.menu_str);
                    $scope.menu = data;
                }
            });

    $scope.menu = {
        button: button.button
    };

    $scope.status = {
        'isEdit': false
    }

    $scope.editModel = {
        menuName: 'xxxx',
        menuLevel: '',
        menuType: '',
        menuExtra: '',
        parentName: ''
    };

    $scope.isSubChange = function() {
        if(!$scope.editModel.parentName.hasOwnProperty('sub_button')) {
            alert('此菜单有链接，无法添加')
            $scope.editModel.parentName = '';
            return false;
        }
    };

    $scope.saveMenu = function() {
        helper.saveMenu({menu_json: angular.toJson($scope.menu)})
              .success(function(data) {
                    alert('操作成功')
              })
    };
    $scope.generateMenu = function() {
        helper.generateMenu()
                .success(function() {
                    alert('操作成功')
                });
    };
});
page.directive('modalBtn', function() {
    return {
        restrict: 'A',
        link: function (scope, ele, attrs) {
            $(ele).on('click', function() {
                $('.modal').modal('show');
            });
            var clearEditModel = function() {
                for(var key in scope.editModel) {
                    scope.editModel[key] = '';
                }
            }
            var getParentByName = function (name) {
                if(typeof name == 'undefined'
                    || name == ''
                    || !scope.menu.button.length)
                    return;
                var _targetObj;
                var _button = scope.menu.button;
                var _i = 0;
                var _len = _button.length;
                for(; _i < _len; _i++) {
                    if(typeof _button[_i].sub_button != 'undefined'
                        && _button[_i].name == name) {
                        _targetObj = _button[_i];
                        break;
                    }
                }
                return _targetObj;
            }
            scope.submit = function() {
                // 如果没有父级，说明是父级菜单
                // 如果没有链接或者click，则没有子级
                if(scope.editModel.parentName == '') {
                    if(scope.menu.button.length == PARENT_LIMIT) {
                        alert('父级菜单个数不超过' + PARENT_LIMIT);
                        clearEditModel();
                        return false;
                    }
                    if(scope.editModel.menuType != '' && scope.editModel.menuExtra != '') {
                        var _newMenu = {
                            'type': scope.editModel.menuType,
                            'name': scope.editModel.menuName
                        };
                        var _typeKey = scope.editModel.menuType == 'view' ? 'url' : 'key';
                        _newMenu[_typeKey] = scope.editModel.menuExtra;
                        scope.menu.button.push(_newMenu);
                    } else {
                        var _newMenu = {
                            'name': scope.editModel.menuName,
                            'sub_button': []
                        }
                        scope.menu.button.push(_newMenu);
                    }
                    clearEditModel();
                } else {
                    var _newMenu = {
                        'type': scope.editModel.menuType,
                        'name': scope.editModel.menuName
                    };
                    var _typeKey = scope.editModel.menuType == 'view' ? 'url' : 'key';
                    _newMenu[_typeKey] = scope.editModel.menuExtra;
                    var _parent = getParentByName(scope.editModel.parentName.name);
                    if(_parent.sub_button.length == SUB_LIMIT) {
                        clearEditModel();
                        return false;
                    }
                    _parent.sub_button.push(_newMenu);
                    clearEditModel();
                    console.log(scope.menu);
                    scope.save(scope.menu);
                }
            };

        }
    };
});
</script>
@endsection