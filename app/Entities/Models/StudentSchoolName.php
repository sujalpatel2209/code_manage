<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSchoolName extends Model
{
    protected $table="student_school_name";
    protected $fillable=['name'];
    protected $dates=['created_at','updated_at'];
}
