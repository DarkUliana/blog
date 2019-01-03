<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $guarded = [];

    public $appends = ['level'];

    public function parent()
    {
        return $this->belongsTo('App\Comment', 'id', 'parent_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\CommentRating');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function children() {

        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }

}
