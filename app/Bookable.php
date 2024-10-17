<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        return  $this->bookings()->betweenDates($from,$to)->count() ? false : true;
    }

    public function priceFor($from,$to): \Illuminate\Http\JsonResponse
    {
        $days=(new Carbon($from))->diffInDays(new Carbon($to));
        $price = $this->price * $days;
        return response()->json([
            'data' =>[
                'total' => $price,
                'breakdown'=>[
                   $this->price => $days,

                ]
            ]
        ]);
    }
}
