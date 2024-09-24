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
