<?php

namespace App\Entities\Models;

use App\AppConstant\AppConstant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{

    use Notifiable;

    protected $table = "users";
    protected $fillable = ['uuid', 'first_name', 'last_name', 'password','email', 'mobile', 'address1', 'address2', 'city', 'state_id', 'countries_id', 'zipcode', 'user_type','image_path'];
    protected $hidden = ['password'];
    protected $dates = ['created_at', 'updated_at'];

    protected $guard_name = AppConstant::USER_GUARD;


    public function setPasswordAttribute($data)
    {
        $this->attributes['password'] = Hash::make($data);
    }

    public function studentInvite()
    {
        return $this->hasMany(StudentInvite::class, 'student_id', 'id');
    }

    public function parentInvite()
    {
        return $this->hasMany(ParentsInvite::class, 'parent_id', 'id');
    }

    public function studentProfile()
    {
        return $this->hasOne(StudentsProfile::class,'user_id','id');
    }
    public function getImagePathAttribute()
    {
        $profilePic = $this->attributes['image_path'];
        if ($profilePic != "") {
            return url('storage/' . $profilePic);
        } else {
//            return url('/assets/img/logo/RBSmalllogo.png');
        }
    }
}
