<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $dates = ['event_date', 'suggested_date'];

    protected $fillable = [
        'title',
        'description',
        'location',
        'city',
        'event_date',
        'status',
        'weather_forecast',
        'user_id',
    ];


    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
