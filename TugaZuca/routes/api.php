<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/types', [TypeController::class, 'index']);
Route::get('/packages/{typeId}', [PackageController::class, 'availableSchedules']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::post('/payments/session', [PaymentController::class, 'createSession']);

// Success and Cancel URLs for Stripe payment
Route::get('/payment-success', function () {
    return response()->json(['message' => 'Payment successful']);
});

Route::get('/payment-cancelled', function () {
    return response()->json(['message' => 'Payment cancelled']);
});