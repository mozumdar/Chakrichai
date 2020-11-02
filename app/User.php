<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Profile;
use App\Company;
use App\User;
use App\Role;
use App\Job;
use App\Application;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    
    public function company(){
        return $this->hasOne(Company::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimeStamps();
    }
    
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function jobs(){
        return $this->belongsToMany('App\Job');
    } 

    public function applications(){
        return $this->hasMany('App\Application');
    }

    public function rejections(){
        return $this->hasMany('App\Rejection');
    }
}