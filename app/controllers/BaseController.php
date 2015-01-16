<?php

use App;

class BaseController extends Controller
{


    protected $layout = 'layouts.default';
    protected $currentUser;
    protected $title = '';
    protected $header = true;
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    protected function view($path, $data = [])
    {
        $this->layout->title = $this->title;
        $this->layout->header = $this->header;
        $this->layout->content = View::make($path, $data);
    }

    protected function redirectTo($url, $statusCode = 302)
    {
        return Redirect::to($url, $statusCode);
    }


    protected function redirectAction($action, $data = [])
    {
        return Redirect::action($action, $data);
    }

    protected function redirectRoute($route, $data = [])
    {
        return Redirect::route($route, $data);
    }

    protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

    protected function redirectIntended($default = null)
    {
        $intended = Session::get('auth.intended_redirect_url');
        if ($intended) {
            return $this->redirectTo($intended);
        }
        return Redirect::to($default);
    }

    public function getUid()
    {
        if(Auth::user())
            return Auth::user()->id;

        $wechatRepo = App::make('\Hgy\Wechat\WechatHelper');
        $openid = $wechatRepo->getOpenId();
        if($openid != null)
            return App::make('\Hgy\Wechat\UserWehatRepository')->getUidByOpenid($openid);
    }

    /**
     * @return mixed 这里的User实际是组织表，为了减少修改，保留User作为名字，
     * 组织信息通过Auth::user查到。。所有信息都与组织信息关联
     */
    public function getCurrentUser()
    {
        $user = Auth::user();
        return $user->Orgs->first();
//        $user = app::make('Hgy\Account\UserRepository');
//        return $user->requireById(Auth::user()->id);
    }
}
