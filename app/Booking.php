<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $guarded = [];

    public function bookable(){
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

    //adding uuid whenever the model stores -->like a seeder
    protected static function boot(){
        parent::boot();
        static::creating(function ($booking) {
            $booking->review_key = Str::uuid();
        });
    }

    // find booking by review key
    public static function findByKey(string $key) : Booking {
        return static::where('review_key', $key)->with('bookable')->get()->first();
    }
}
