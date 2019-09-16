<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public static function rules ($id = 0, $extendedRules = [])
    {

        $rules = array(
            'title'         => 'required|max:255',
            'content'       => 'required',
        );

        return array_merge($rules, $extendedRules);
    }

    public static function messages ($extendedMessages = [])
    {
        $messages = array();

        return array_merge($messages, $extendedMessages);
    }

    public function author ()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function author_full_name ()
    {
        if ($this->author) {
            return trim(implode(' ', [$this->author->first_name, $this->author->last_name]));    
        }
        
        return '';
    }

    public function category ()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function category_name ()
    {
        if ($this->category) {
            return $this->category->name;    
        }
        
        return '';
    }
}