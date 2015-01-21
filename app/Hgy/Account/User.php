<?php namespace Hgy\Account;

use Hgy\Wechat\Menu;
use Hgy\Activity\Activities;
use Hgy\Core\Entity;
use Hgy\VltField\VltAttribute;
use Hgy\Volunteer\Volunteer;
use Hgy\Wechat\Channel;
use Hgy\WechatBind\OrgWechatBind;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;
use McCool\LaravelAutoPresenter\PresenterInterface;

class User extends Entity implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait, HasRole;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    protected $guarded = [];
    /**
     * do not save pasword_confirmation
     * @var bool
     */
    public $autoPurgeRedundantAttributes = true;

//    public static $rules = array(
//        'orgName'				=> 'required|between:4,16',
//        'email'                 => 'required|email',
//        'password'              => 'required|alpha_num|between:4,12|confirmed',
//        'password_confirmation' => 'required|alpha_num|between:4,12'
//
//    );

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function Activities()
    {
        return $this->hasMany(Activities::class,'bizid');
    }

    public function userinfos()
    {
        return $this->hasOne('Hgy\Account\UserInfo','uid');
    }

    public function VltAttributes()
    {
        return $this->hasMany(VltAttribute::class,'vol_id');// 这里的vol_id值得就是org_id
    }

    public function Tokens()
    {
        return $this->hasMany(OrgWechatBind::class, 'org_id');
    }

    //弃用
    public function volunteers()
    {
        return $this->hasMany('Hgy\Volunteer\Volunteer','org_id');
    }

    public function CVolunteers()
    {
        return $this->belongsToMany(UserBase::class,'user_volunteer','org_id','vol_id')
                    ->withPivot(['group_id', 'is_verify', 'is_lock']);
    }

    /**
     * 有合表的可能
     */
    public function VltValues()
    {
        return $this->belongsToMany(UserBase::class,'volinfo_value','org_id','vol_id')
                    ->withPivot(['value']);
    }

    public function volunteerGroup()
    {
        return $this->hasMany('Hgy\Volunteer\VolunteerGroup','org_id');
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

//    public function beforeSave()
//    {
//        // if there's a new password, hash it
//        if($this->isDirty('password')) {
//            $this->password = \Hash::make($this->password);
//        }
//
//        if($this->_isUserExist($this->email,$this->orgName)) {
//            $this->errors()->add('account_error','该用户已经被注册');
//            return false;
//        }
//        return true;
//        //or don't return nothing, since only a boolean false will halt the operation
//    }
//
//
//    private function _isUserExist($email,$orgName)
//    {
//        return self::Where(function($query) use ($email,$orgName)
//        {
//            $query->where('email','=',$email)
//                ->orWhere('orgName','=',$orgName);
//        })->first();
//    }

    /**
     * 管理员
     */
    public function Admins()
    {
        return $this->belongsToMany(UserBase::class, 'admin_user', 'org_id', 'user_id');
    }

    public function Channel()
    {
        return $this->hasOne(Channel::class, 'orgid');
    }

    public function Menu()
    {
        return $this->hasOne(Menu::class, 'org_id');
    }

//

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
//    public function getReminderEmail()
//    {
//        // TODO: Implement getReminderEmail() method.
//    }
//
//    /**
//     * Get the unique identifier for the user.
//     *
//     * @return mixed
//     */
//    public function getAuthIdentifier()
//    {
//        // TODO: Implement getAuthIdentifier() method.
//    }
//
//    /**
//     * Get the password for the user.
//     *
//     * @return string
//     */
//    public function getAuthPassword()
//    {
//        // TODO: Implement getAuthPassword() method.
//    }
}
