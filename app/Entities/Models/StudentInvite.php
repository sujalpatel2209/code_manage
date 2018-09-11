<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInvite extends Model
{
    protected $table="student_invite";
    protected $fillable=['student_id','relation','first_name','last_name','email','mobile'];
    protected $dates=['created_at','updated_at'];

    public function userRelation()
    {
        return $this->hasMany(Users::class,'student_id','id');
    }
}
