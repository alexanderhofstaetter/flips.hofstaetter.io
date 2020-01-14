<?php

namespace App;

use Carbon\Carbon;
use Event;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'points_max', 'points_sum', 'teacher_name', 'title', 'comments', 'date', 'entry_date', 'source_id', 'type', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $casts = [
        'points_max' => 'float',
        'points_sum' => 'float',
        'date' => 'datetime',
        'entry_date' => 'datetime'
    ];

    public static function boot() {
        parent::boot();

        static::created(function($grade) {
            Event::dispatch('grade.created', $grade);
        });
        static::updated(function($grade) {
            Event::dispatch('grade.updated', $grade);
        });
    }

    public function setEntryDateAttribute($value)
    {   if ($value != NULL)
            $this->attributes['entry_date'] = Carbon::createFromFormat('d.m.Y H:i:s', $value);
    }

    public function setCommentsAttribute($value)
    {   if ($value == "") $value = NULL;
        $this->attributes['comments'] = $value;
    }

    public function setDateAttribute($value)
    {   if ($value != NULL)
            $this->attributes['date'] = Carbon::createFromFormat('d.m.Y H:i:s', $value);
    }

    public function setPointsSumAttribute($value)
    {   if ($value == "") $value = NULL;
        else if ( is_string($value) ) $value = floatval(str_replace(',', '.', $value));
        $this->attributes['points_sum'] = $value;
    }

    public function setPointsMaxAttribute($value)
    {   if ($value == "") $value = NULL;
        else if ( is_string($value) ) $value = floatval(str_replace(',', '.', $value));
        $this->attributes['points_max'] = $value;
    }

    public function lv()
    {
        return $this->belongsTo('App\Lv');
    } 
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
