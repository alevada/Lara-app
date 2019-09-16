<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public static function rules ($id = 0, $extendedRules = [])
    {
        $rules = array();

        return array_merge($rules, $extendedRules);
    }

    public static function messages ($extendedMessages = [])
    {
        $messages = array();

        return array_merge($messages, $extendedMessages);
    }

    public function user () 
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}