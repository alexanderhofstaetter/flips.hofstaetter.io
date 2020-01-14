<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lv extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'gradebook', 'semester', 'url_gradebook', 'number', 'key', 'status'
    ];

    protected $casts = [
        'gradebook' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function getSemesterTextAttribute()
    {   $value = strtolower($this->semester);
        if (strpos($value, 'w') !== false) {
            $value = str_replace("w", "", $value);
            $value = "Wintersemester 20" . $value . '/20' . strval(intval($value)+1);
        }
        else if (strpos($value, 's') !== false) {
            $value = str_replace("s", "", $value);
            $value = "Sommersemester 20" . $value;
        }
        return $value;
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    } 

    public function news()
    {
        return $this->hasMany('App\News');
    }    
}
