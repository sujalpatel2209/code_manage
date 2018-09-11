<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class ParentsInvite extends Model
{
    protected $table="parents_invite";
    protected $fillable=["parent_id","relation","first_name","last_name","email","mobile"];
    protected $dates=['created_at','updated_at'];


    public function userRelation()
    {
        return $this->hasMany(Users::class,'parent_id','id');
    }
}
