<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class UsersActivities extends Model
{
    protected $table="users_activities";
    protected $fillable=['user_id','activities_id'];
    protected $dates=['created_at','updated_at'];
}
