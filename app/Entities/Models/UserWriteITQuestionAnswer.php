<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class UserWriteITQuestionAnswer extends Model
{
    protected $table="user_writeit_question_answer";

    protected $fillable=['user_id','user_que_ans_id','answer','college_year_id','answer2'];

    protected $dates=['created_at','updated_at'];

    public function collegeYear()
    {
        return $this->hasOne(CollegeYears::class,'id','college_year_id');
    }


}
