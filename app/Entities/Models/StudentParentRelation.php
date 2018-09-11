<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class StudentParentRelation extends Model
{
    protected $table="student_parent_relation";
    protected $fillable=['student_id',"parent_id","relation"];
    protected $dates=['created_at','updated_at'];
}
