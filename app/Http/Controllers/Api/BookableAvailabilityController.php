<?php

namespace App\Http\Controllers\Api;
use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id,Request $request)
    {
        $data=$request->validate([
           'from'=>'required|date_format:Y-m-d|after_or_equal:today',
           'to'=>'required|date_format:Y-m-d|after_or_equal:from',
        ]);
        $bookable=Bookable::findOrFail($id);
        return $bookable->checkAvailability($data['from'],$data['to'])
            ? response()->json([])
            :  response()->json([],404);
    }
}
