<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<link rel="icon" href="images/favicon.ico">--}}

    <title>哈公益</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css">
    {{ HTML::style('/styles/carousel.css') }}

  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="header-title"><img src="{{URL::asset('/images/home/hagongyi-3.png')}}"><span CLASS="fl">H A G O N G Y I.C O M</span></div>
          <div class="container fr nav-footer">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页</a></li>
                <li><a href="#about">功能</a></li>
                <li><a href="#contact">用户</a></li>
                <li><a href="#contact">登陆</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="{{URL::asset('/images/home/hgy.png')}}" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1></h1>
              <p></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="{{URL::asset('/images/home/hgy.png')}}" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1></h1>
              <p></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="{{URL::asset('/images/home/hgy.png')}}" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1></h1>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row featurette row-center row-bg1">
      <div class="col-container">
        <div class="col-lg-2 fl">
          <div class="thumbnail">
            <img src="{{URL::asset('/images/home/setting.png')}}" width='20%'>
            <span>Nao功能</span>
            <ul>
              <li>活动流程管理</li>
              <li>一键多平台发布</li>
              <li>志愿者信息归档</li>
              <li>组织名片</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 fl">
          <div class="thumbnail">
            <img src="{{URL::asset('/images/home/users.png')}}" width='20%'>
            <span>志愿者功能</span>
            <ul>
              <li>活动查询报名</li>
              <li>各大社交媒体</li>
              <li>活动意见反馈</li>
              <li>志愿者名片</li>
            </ul>
          </div>
        </div>
        </div>
      </div>

      <div class="row featurette row-center row-bg2">
      <div class="col-container">
        <h2>正在使用用户</h2>
        <div class="col-lg-3 fl">
          <div class="thumbnail">
            <img src="{{URL::asset('/images/home/user1.png')}}" width='60%'>
            <ul>
              <li>名称：哈公益001</li>
              <li>评论：哈公益＊＊＊＊＊</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 fl">
          <div class="thumbnail">
            <img src="{{URL::asset('/images/home/user1.png')}}" width='60%'>
            <ul>
              <li>名称：哈公益001</li>
              <li>评论：哈公益＊＊＊＊＊</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 fl">
          <div class="thumbnail">
            <img src="{{URL::asset('/images/home/user1.png')}}" width='60%'>
            <ul>
              <li>名称：哈公益001</li>
              <li>评论：哈公益＊＊＊＊＊</li>
            </ul>
          </div>
        </div>
      <div class="users-nav">
        <img src="{{URL::asset('/images/home/LR.png')}}" width="22%">
      </div>
      </div>
      </div>
      <!-- START THE FEATURETTES -->

      <div class="row featurette row-bg3">
        <div class="col-md-5">
          <img src="{{URL::asset('/images/home/logo-max.png')}}">
          <ul>
            <h1>哈公益</h1>
            <h3>H A G O N G Y I.C O M</h3>
          </ul>
        </div>

        <div class="col-md-7 fr">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#register" role="tab" data-toggle="tab">组织注册</a></li>
            <li role="presentation"><a href="#login" role="tab" data-toggle="tab">组织登陆</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="register">
                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">手机号／邮箱</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="用户名">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">密码</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="密码">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                      <button type="submit" class="btn btn-default">注册</button>&nbsp;
                      <button type="submit" class="btn btn-default">登陆</button>
                    </div>
                  </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="login">
                <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">手机号／邮箱</label>
                                    <div class="col-sm-7">
                                      <input type="email" class="form-control" id="inputEmail3" placeholder="用户名">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">密码</label>
                                    <div class="col-sm-7">
                                      <input type="password" class="form-control" id="inputPassword3" placeholder="密码">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-6">
                                      <button type="submit" class="btn btn-default">注册</button>&nbsp;
                                      <button type="submit" class="btn btn-default">登陆</button>
                                    </div>
                                  </div>
                                </form>
            </div>
          </div>
        </div>
      </div>

      {{--<hr class="featurette-divider">--}}

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        {{--<p class="pull-right"><a href="#">TOP</a></p>--}}
        <div class="content">
        <ul>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <div style="clear:both;"></div>
        </ul>
        <ul>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <li><img src="{{URL::asset('/images/home/ico1.png')}}"></li>
            <div style="clear:both;"></div>
        </ul>
        </div>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->

    <!-- Latest compiled and minified JavaScript -->
    {{ HTML::script('http://libs.baidu.com/jquery/2.0.0/jquery.js') }}
    {{ HTML::script('styles/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js') }}
    {{ HTML::script('scripts/docs.min.js') }}
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{ HTML::script('scripts/ie10-viewport-bug-workaround.js') }}


</body>
</html>