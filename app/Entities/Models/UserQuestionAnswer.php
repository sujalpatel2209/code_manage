<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestionAnswer extends Model
{
    protected $table="user_question_answer";
    protected $fillable=['user_id','writeit_question_id'];
    protected $dates=['created_at','updated_at'];

    public function userWriteITAnswer()
    {
        return $this->hasMany(UserWriteITQuestionAnswer::class,'user_que_ans_id', 'id');
    }
}
