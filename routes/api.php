<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('bookables', 'Api\BookableController');
Route::get('bookables/{id}/availability', 'Api\BookableAvailabilityController')->name('bookables.availability.show');
Route::get('bookables/{id}/reviews', 'Api\BookableReviewsController')->name('bookables.reviews.show');
Route::get('bookables/{id}/price', 'Api\BookablePriceController')->name('bookables.price.show');
Route::apiResource('reviews', 'Api\ReviewController')->only(['show','store']);
Route::get('bookingsByReview/{id}', 'Api\BookingByReviewController');
Route::post('checkout', 'Api\CheckoutController')->name('checkout');
