<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function createSession(Request $request) {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);
        
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create([
            'payment_method_types' => ['card','paypal'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => ['name' => 'Class Booking'],
                    'unit_amount' => $booking->type->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/payment-success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/payment-cancelled'),
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'stripe_session_id' => $session->id,
            'amount' => $booking->type->price,
            'status' => 'pending',
        ]);

        return response()->json(['url' => $session->url]);
    }
}
