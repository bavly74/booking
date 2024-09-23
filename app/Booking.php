<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function bookings(){
        return $this->belongsTo(Bookable::class);
    }

    public function review(){
        return $this->hasOne(Review::class);
    }

    //returning availability (local scope query)
    public function scopeBetweenDates(Builder $query, $from, $to)
    {
        return $query->where('to', '>=', $from)->where('from', '<=', $to);
    }
}
