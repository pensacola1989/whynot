<div class="container">
    {{--{{ Form::open(array('action'    =>  'UserController@register','method'  =>  'post')) }}--}}
      {{--<div class="form-group">--}}
        {{--{{ Form::label('inputEmail','Email',array('class'   =>  'col-sm-2 control-label')) }}--}}
        {{--<div class="col-sm-10">--}}
          {{--<input type="email" class="form-control" id="inputEmail" placeholder="Email">--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--{{ Form::close() }}--}}
    <form method="POST" action="{{ action('UserController@register', []) }}" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">Email：</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
          <label for="inputUserName" class="col-sm-2 control-label">用户名：</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail" placeholder="用户名">
          </div>
        </div>
      <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">密码：</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" placeholder="密码">
        </div>
      </div>
      <div class="form-group">
          <label for="inputPassword2" class="col-sm-2 control-label">确认密码：</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword2" placeholder="确认密码">
          </div>
        </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox"> 我已阅读
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">注&nbsp;&nbsp;&nbsp;&nbsp;册</button>
        </div>
      </div>
    </form>
</div>
