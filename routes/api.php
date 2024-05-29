<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\HotelController;
use App\Http\Controllers\api\v1\RoomController;
use App\Http\Controllers\api\v1\SeasonController;
use App\Http\Controllers\api\v1\RateController;
use App\Http\Controllers\api\v1\ReservationController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('api/v1')->group(function () {
    Route::get('hotels', [HotelController::class, 'index']);
    Route::post('hotels', [HotelController::class, 'store']);
    Route::get('hotels/{id}', [HotelController::class, 'show']);
    Route::put('hotels/{id}', [HotelController::class, 'update']);
    Route::delete('hotels/{id}', [HotelController::class, 'destroy']);

    Route::get('rooms', [RoomController::class, 'index']);
    Route::post('rooms', [RoomController::class, 'store']);
    Route::get('rooms/{id}', [RoomController::class, 'show']);
    Route::put('rooms/{id}', [RoomController::class, 'update']);
    Route::delete('rooms/{id}', [RoomController::class, 'destroy']);

    Route::get('seasons', [SeasonController::class, 'index']);
    Route::post('seasons', [SeasonController::class, 'store']);
    Route::get('seasons/{id}', [SeasonController::class, 'show']);
    Route::put('seasons/{id}', [SeasonController::class, 'update']);
    Route::delete('seasons/{id}', [SeasonController::class, 'destroy']);

    Route::get('rates', [RateController::class, 'index']);
    Route::post('rates', [RateController::class, 'store']);
    Route::get('rates/{id}', [RateController::class, 'show']);
    Route::put('rates/{id}', [RateController::class, 'update']);
    Route::delete('rates/{id}', [RateController::class, 'destroy']);

    Route::get('reservations', [ReservationController::class, 'index']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations/{id}', [ReservationController::class, 'show']);
    Route::put('reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy']);
    //
    Route::get('reservations/check-hotel-availability', [ReservationController::class, 'checkHotelAvailability']);
    Route::get('reservations/get-hotel-rates', [ReservationController::class, 'getHotelRates']);
});