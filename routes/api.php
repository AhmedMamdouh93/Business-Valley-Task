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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    Route::get('hotel-search', 'HotelController@search');

});

Route::get('insertHotel','HotelController@insertHotel');

// http://localhost:8000/api/hotel-search?from_date=2020-01-25&to_date=2020-01-31&city=CAI&adults_number=4
Route::get('hotel-search', 'HotelController@search');
