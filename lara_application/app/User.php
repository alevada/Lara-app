<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public static function rules ($id = 0, $extendedRules = [])
    {
        $rules = array(
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,email,'.$id,
            'password'      => 'confirmed'
        );

        return array_merge($rules, $extendedRules);
    }

    public static function messages ($extendedMessages = [])
    {
        $messages = array();

        return array_merge($messages, $extendedMessages);
    }

    public function posts () 
    {
        return $this->hasMany('App\Post', 'author_id', 'id');
    }

    public function name () {
        $name = trim(implode(' ', array($this->first_name, $this->last_name)));

       return $name != '' ? $name : $this->email;
    }

    public function role ()
    {
        return $this->hasOne('App\UserRole', 'id', 'role_id');
    }

    /**
     * Check if user has admin rights
     *
     * @return boolean
     */
    public function isAdmin () {
        return $this->role->slug == 'admin';
    }    

    /**
     * Check if user has publisher rights
     *
     * @return boolean
     */
    public function isPublisher () {
        return $this->role->slug == 'publisher';
    }

}
