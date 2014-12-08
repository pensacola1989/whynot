<div class="container">
    <div class="register_step row">
      <div class="col-md-4 step_item {{ $step == 1 ? 'current' :'' }}">第一步：注册  <i class="glyphicon glyphicon-chevron-right"></i></div>
      <div class="col-md-4 step_item {{ $step == 2 ? 'current' :'' }}">第二步：补充信息  <i class="glyphicon glyphicon-chevron-right"></i></div>
      <div class="col-md-4 step_item {{ $step == 3 ? 'current' :'' }}">第三步：审核信息  <i class="glyphicon glyphicon-chevron-right"></i></div>
    </div>

      @if($step == 1)
      {{ Form::open(array('action'    =>  'UserController@register','method'  =>  'post','class'=>'container form-horizontal','role'=>'form')) }}

      <div class="form-group">
        {{ Form::label('email','Email',array('class'   =>  'col-sm-2 control-label')) }}
        <div class="col-sm-10">
        {{ Form::text('email','',array('class'=>'form-control',"id"=>"inputEmail", "placeholder"=>"Email")) }}
        </div>
      </div>
      {{--<div class="form-group">--}}
        {{--{{ Form::label('orgName','机构名：',array('class'    =>  'col-sm-2 control-label'))  }}--}}
        {{--<div class="col-sm-10">--}}
         {{--{{ Form::text('orgName','',array('class'=>'form-control',"id"=>"inputUserName", "placeholder"=>"机构名：")) }}--}}
        {{--</div>--}}
      {{--</div>--}}
      <div class="form-group">
          {{ Form::label('username','用户名：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
           {{ Form::text('username','',array('class'=>'form-control',"id"=>"inputUserName", "placeholder"=>"用户名 ：")) }}
          </div>
        </div>
      <div class="form-group">
        {{ Form::label('password','密码：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
          {{ Form::password('password',array('class'=>'form-control',"id"=>"inputPassword", "placeholder"=>"密码：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation','确认密码：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::password('password_confirmation',array('class'=>'form-control',"id"=>"inputPassword2", "placeholder"=>"确认密码：")) }}
          </div>
        </div>
         <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
              {{ Form::checkbox('agree','true') }} 我已阅读
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
            <i class="hgy-icon glyphicon glyphicon-user"></i>  下一步  </button>
            <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
    {{ Form::close() }}
        @elseif($step == 2)
        {{ Form::open(array('action'    =>  array('UserController@register',2,$uid),'method'  =>  'post','class'=>'container form-horizontal','role'=>'form')) }}
        <input type="hidden" name="step" value="2"/>
        <div class="form-group">
            {{ Form::label('u_cp_unit','主管单位：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_cp_unit','',array('class'=>'form-control',"id"=>"u_cp_unit", "placeholder"=>"主管单位：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_pw_industry','公益行业：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_pw_industry','',array('class'=>'form-control',"id"=>"u_pw_industry", "placeholder"=>"公益行业：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_province','所在省份：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_province','',array('class'=>'form-control',"id"=>"u_province", "placeholder"=>"所在省份：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_address','地址：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_address','',array('class'=>'form-control',"id"=>"u_address", "placeholder"=>"地址：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_postcode','邮编：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_postcode','',array('class'=>'form-control',"id"=>"u_postcode", "placeholder"=>"邮编：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_teamsize','团队人数：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_teamsize','',array('class'=>'form-control',"id"=>"u_teamsize", "placeholder"=>"团队人数：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_target_area','目标地区：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_target_area','',array('class'=>'form-control',"id"=>"u_target_area", "placeholder"=>"目标地区：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_target_people','目标人群：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_target_people','',array('class'=>'form-control',"id"=>"u_target_people", "placeholder"=>"目标人群：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_username','用户名：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_username','',array('class'=>'form-control',"id"=>"u_username", "placeholder"=>"用户名：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_mobile','手机号：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_mobile','',array('class'=>'form-control',"id"=>"u_mobile", "placeholder"=>"手机号：")) }}
          </div>
        </div>
        <div class="form-group">
            {{ Form::label('u_other_contact','其他联系方式：',array('class'    =>  'col-sm-2 control-label'))  }}
          <div class="col-sm-10">
            {{ Form::text('u_other_contact','',array('class'=>'form-control',"id"=>"u_other_contact", "placeholder"=>"其他联系方式：")) }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
            <i class="hgy-icon glyphicon glyphicon-user"></i>  下一步  </button>
            <p style="color:red;">{{ $errors->first() }}</p>
          </div>
        </div>
            {{ Form::close() }}
        @elseif(!$is_verify)

        <h3 style="padding-left: 100px;color:#2980B9;">
            <i class="glyphicon glyphicon-info-sign"></i> &nbsp;&nbsp;
            您的信息已经提交，请等待审核
        </h3>
        @else
        <h3 style="padding-left: 100px;color:#2980B9;">
            <p><i class="glyphicon glyphicon-info-sign"></i> &nbsp;&nbsp;您的信息已经审核通过，请直接登录</p>
            <p>
                <a href="/user/login" type="submit" class="btn btn-success">
                <i class="hgy-icon glyphicon glyphicon-user"></i>  登&nbsp;&nbsp;录
                </a>
            </p>
        </h3>
        @endif

</div>
