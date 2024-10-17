<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Bookable;
use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $data=$request->validate([
            'bookings'=>'required|array',
            'bookings.*.bookable_id'=>'required|exists:bookables,id',
            'bookings.*.from'=>'required|date|after_or_equal:today',
            'bookings.*.to'=>'required|date|after_or_equal:bookings.*.from',
            'customer.first_names'=>'required',
            'customer.last_name'=>'required',
            'customer.email'=>'required|email',
            'customer.street'=>'required',
            'customer.city'=>'required',
            'customer.state'=>'required',
            'zip'=>'required',
            'country'=>'required',
        ]);

        $data = array_merge($data, $request->validate([
            'bookings.*' => ['required', function ($attribute, $value, $fail) {
                $bookable = Bookable::findOrFail($value['bookable_id']);
                if (!$bookable->checkAvailability($value['from'], $value['to'])) {
                    $fail("The object is not available in given dates!");
                }
            }]
        ]));

        $bookingData=$data['bookings'];
        $customerData=$data['customer'];

        $bookings=collect($bookingData)->map(function ($bookingData) use ($customerData) {
            $bookable = Bookable::findOrFail($bookingData['bookable_id']);
            $booking= new Booking();
            $booking->bookable_id = $bookingData['bookable_id'];
            $booking->from=$bookingData['from'];
            $booking->to=$bookingData['to'];
            $booking->price = $bookable->priceFor($booking->from, $booking->to)['total'];
            $booking->bookable()->associate($bookable);
            $booking->address()->associate(Address::create($customerData['address']));
            $booking->save();
        });
        return response()->json([
            'message'=>'Booking has been booked',
        ]);

    }
}
