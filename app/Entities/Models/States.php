<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table="states";
    protected $fillable=['name','countries_id'];
    protected $dates=['created_at','updated_at'];
}
