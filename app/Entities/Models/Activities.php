<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $table="activities";
    protected $fillable=['name'];
    protected $dates=['created_at','updated_at'];
}
