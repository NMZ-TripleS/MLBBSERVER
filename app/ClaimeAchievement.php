<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimeAchievement extends Model
{
    protected $table="claime_achievements";
    //
    protected $fillable=['user_id','achievement_id'];
}
