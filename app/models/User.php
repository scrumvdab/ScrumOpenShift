<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

    public static $rules = array(
        'firstname' => 'required|alpha|min:2',
        'lastname' => 'required|alpha|min:2',
        'username' => 'required|alpha|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12'
    );

    use UserTrait,
        RemindableTrait;

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

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function setRememberToken($remember_token) {
        $this->remember_token = $remember_token;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function isAdmin() {
        return ($this->lvl_auth == 2);
    }

    public function isMedewerker() {
        return ($this->lvl_auth == 1);
    }

}
