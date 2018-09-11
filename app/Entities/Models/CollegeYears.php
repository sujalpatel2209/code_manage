<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeYears extends Model
{
    protected $table = "college_year";
    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];
}
