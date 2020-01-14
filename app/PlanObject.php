<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class PlanObject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'internal_id', 'name', 'order', 'type', 'attempts', 'attempts_max', 'depth', 'date', 'result', 'lv_url', 'lv_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function setDateAttribute($value)
    {   if ($value != NULL)
            $this->attributes['date'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
