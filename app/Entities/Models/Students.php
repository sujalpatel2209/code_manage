<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table="student";
    protected $fillable=['first_name','last_name','email','mobile','password','address1','address2','city','state_id','countries_id','zipcode'];
//    protected $hidden=['password'];
    protected $dates=['created_at','updated_at'];
}
