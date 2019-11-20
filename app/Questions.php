<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $fillable = [
        'wrong_count', 'right_count'
    ];
}
