<?php

use App\Models\Payment;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\Stripe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $types = Type::where('is_active', true)->get();
    return view('website.home',compact('types'));
});
Route::get('/packages/{typeId}', function ($typeId) {
    $type = Type::with('packages')->findOrFail($typeId); // Fetch Type with related Packages

    return view('website.packages', compact('type'));
})->name('packages.index');

Route::post('/stripe/webhook', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $payload = $request->all();

    if ($payload['type'] === 'checkout.session.completed') {
        $sessionId = $payload['data']['object']['id'];

        $payment = Payment::where('stripe_session_id', $sessionId)->first();

        if ($payment) {
            $payment->update(['status' => 'paid']);
            $payment->booking->update(['status' => 'confirmed']);
        }
    }

    return response()->json(['status' => 'success']);
});