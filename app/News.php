<?php

namespace App;

use Carbon\Carbon;
use Event;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'url', 'date', 'number', 'title', 'content', 'lv_id'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public static function boot() {
        parent::boot();

        static::created(function($news) {
            Event::fire('news.created', $news);
        });
        static::updated(function($news) {
            Event::fire('news.updated', $news);
        });
    }
    
    public function lv()
    {
        return $this->belongsTo('App\Lv');
    }

    public function setDateAttribute($value)
    {   if ($value != NULL)
            $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
    }
}
