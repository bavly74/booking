<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingReviewsIndexResource;
use Illuminate\Http\Request;

class BookableReviewsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id , Request $request)
    {
        $bookable=Bookable::findOrFail($id);


        return BookingReviewsIndexResource::collection(
         $bookable->reviews()->latest()->get()
        );

    }
}
