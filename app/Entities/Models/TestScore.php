<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    protected $table="test_score";
    protected $fillable=['subject','score','date','test_subject_id'];
    protected $dates=['created_at','updated_at'];
}
