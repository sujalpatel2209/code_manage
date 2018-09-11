<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class TestSubject extends Model
{
    protected $table="test_subject";
    protected $fillable=['name'];
    protected $dates=['created_at','updated_at'];
}
