<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    protected $guarded = [];
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function checkAvailability($from,$to) :bool {
        return $this->bookings()->betweenDates($from,$to)->count();
    }
}
