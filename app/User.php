<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        parent::boot();

        # self::created(function($model){
        #     $model->flips()->create();
        # });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'wulogin', 'wupassword', 'wuregistered_at', 'wuemail', 'wuidentification',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'wupassword'
    ];

    public function getNameAttribute()
    {   return $this->firstname . ' ' . $this->lastname;
    }

    public function flips()
    {   return $this->hasOne('App\Flips');
    }

    public function lvs()
    {   return $this->belongsToMany('App\Lv')->withTimestamps();
    }  

    public function grades()
    {   return $this->hasMany('App\Grade');
    } 

    public function exams()
    {
        return $this->hasMany('App\Exam');
    } 

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function planobjects()
    {
        return $this->hasMany('App\PlanObject');
    }

    public function wulearn()
    {
        return new UserWuLearn($this);
    }

    public function wulpis()
    {
        return new UserWuLpis($this);
    }
}