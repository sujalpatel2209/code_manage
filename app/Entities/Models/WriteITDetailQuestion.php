<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class WriteITDetailQuestion extends Model
{
    protected $table="writeit_detail_question";

    protected $fillable=['question'];

    protected $dates=['created_at','updated_at'];
}
