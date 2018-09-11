<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class UserPersonalAnswer extends Model
{
    protected $table="user_personal_answer";

    protected $fillable=['user_id','personal_question_id','answer'];

    protected $dates=['created_at','updated_at'];
}
