<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    public $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
