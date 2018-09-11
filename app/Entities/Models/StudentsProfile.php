<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsProfile extends Model
{
    protected $table="student_profile";
    protected $fillable=['user_id','weight','unweight','about_description','birth_date','school_name','school_year','school_city','graduation_year','gender','state_id'];
    protected $dates=['created_at','updated_at'];

}
