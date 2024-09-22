<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function bookings(){
        return $this->belongsTo(Bookable::class);
    }
}
