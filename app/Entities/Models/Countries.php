<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table="countries";
    protected $fillable=['name'];
    protected $dates=['created_at','updated_at'];
}
