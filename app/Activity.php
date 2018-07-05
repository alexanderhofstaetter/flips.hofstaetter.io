<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'identifier', 'event', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}