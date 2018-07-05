<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Event;

class Exam extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'file', 'date', 'exam_id'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function boot() {
        parent::boot();

        static::created(function($exam) {
            Event::fire('exam.created', $exam);
        });
        static::updated(function($exam) {
            Event::fire('exam.updated', $exam);
        });
    }

    public function setDateAttribute($value)
    {   if ($value != NULL)
            $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
