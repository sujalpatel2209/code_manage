<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class WriteITQuestion extends Model
{
    protected $table="writeit_question";

    protected $fillable=['question','description','question_type'];

    protected $dates=['created_at','updated_at'];
}
