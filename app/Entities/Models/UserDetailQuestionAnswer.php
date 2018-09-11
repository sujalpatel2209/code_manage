<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetailQuestionAnswer extends Model
{
    protected $table="user_detail_question_answer";

    protected $fillable=['user_que_ans_id','detail_question_id','answer'];

    protected $dates=['created_at','updated_at'];
}
