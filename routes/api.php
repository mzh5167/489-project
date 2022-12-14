<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TimeSlotController;

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

// Used for ajax
Route::get('/get_halls', [HallController::class, 'serve_halls']);
Route::get('/get_time_slots', [TimeSlotController::class, 'serve_time_slots']);

Route::get('/get_seats', [SeatController::class, 'serve_seats']);

Route::get('/get_bookings', [BookingController::class, 'serve_bookings']);


Route::get('/search', [MovieController::class, 'search']);
