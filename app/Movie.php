<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
    	'id','name','up_votes','down_votes'
    ];
}
