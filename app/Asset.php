<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'user_id', 'd_count', 't_d_count','p_count','t_p_count','fout_one_count','three_one_count'
    ];

}
