<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $guarded = [];

    public function parent()
    {
        return $this->hasOne('App\Comment', 'id', 'parent_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\CommentRating');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
