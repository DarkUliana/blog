<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!$request->ajax()) {

            abort(404);
        }
    }
}
