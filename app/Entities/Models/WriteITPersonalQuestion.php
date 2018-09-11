<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class WriteITPersonalQuestion extends Model
{
    protected $table="writeit_personal_question";

    protected $fillable=['question'];

    protected $dates=['created_at','updated_at'];
}
