<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMethod extends Model
{
    protected $table="contact_method";
    protected $fillable=['mobile','skype_id','other','contact_by','user_id'];
    protected $dates=['created_at','updated_at'];
}
