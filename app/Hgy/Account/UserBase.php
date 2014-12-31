<?php namespace Hgy\Account;

use Hgy\Activity\ActivityAttributeValue;
use Hgy\Core\Entity;
use Hgy\Volunteer\Volunteer;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/6/14
 * Time: 1:44 AM
 */

class UserBase extends Entity implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $guarded = [];

    protected $table = 'userbase';

    protected $hidden = ['password', 'remember_token'];

    /**
     * do not save pasword_confirmation
     * @var bool
     */
    public $autoPurgeRedundantAttributes = true;

    public static $rules = array(
        'email'                 => 'required|email',
        'password'              => 'required|alpha_num|between:4,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:4,12'

    );

    public function attendActivities()
    {
        return $this->hasMany(ActivityAttributeValue::class, 'uid');
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function Orgs()
    {
        return $this->belongsToMany(User::class, 'admin_user', 'user_id', 'org_id');
    }

    /**
     * 普通用户，有一个userBase，就会产生一个Volunteer
     */
    public function Volunteer()
    {
        return $this->hasOne(Volunteer::class, 'u_base_id');
    }

    public function beforeSave()
    {
        // if there's a new password, hash it
        if($this->isDirty('password')) {
            $this->password = \Hash::make($this->password);
        }

        if($this->_isUserExist($this->email,$this->username)) {
            $this->errors()->add('account_error','该用户已经被注册');
            return false;
        }
        return true;
        //or don't return nothing, since only a boolean false will halt the operation
    }


    private function _isUserExist($email,$userName)
    {
        return self::Where(function($query) use ($email,$userName)
        {
            $query->where('email','=',$email)
                ->orWhere('username','=',$userName);
        })->first();
    }
}