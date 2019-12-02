<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
    protected $table="energys";
    //
    protected $fillable=[
        'user_id',
        'energy_count',
        'last_request_time'
    ];
}
