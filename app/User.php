<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'cellphone',
        'occupation',
        'role_id',
        'email',
        'password',
        'verified',
        'email_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Set the verified status to true and make the email token null
    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

    public function photos(){
        return $this->morphToMany('App\Photo', 'photoable');
    }

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function lessons(){
        return $this->belongsToMany('App\Lesson')->withPivot('bought','bought_time');
    }

    public function posts(){
        return $this->hasMany('App\Lesson');
    }

    public function AdminRole(){
        if($this->role_id == 1){
            return true;
        }
        return false;
    }

    public function UserRole(){
        if($this->role_id == 2){
            return true;
        }
        return false;
    }
}
