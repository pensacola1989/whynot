<?php namespace Hgy\Account;

use Hgy\Core\Entity;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

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

    public static $rules = array(
        'orgName'				=> 'required|between:4,16',
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

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function beforeSave() {
        // if there's a new password, hash it
        if($this->isDirty('password')) {
            $this->password = \Hash::make($this->password);
        }

        return true;
        //or don't return nothing, since only a boolean false will halt the operation
    }
}
