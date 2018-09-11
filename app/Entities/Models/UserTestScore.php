<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class UserTestScore extends Model
{
    protected $table="users_test_score";
    protected $fillable=['user_id','test_score_id'];
    protected $dates=['created_at','updated_at'];
}
