<?php namespace Hgy\Account;

use Hgy\Core\Entity;
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
}