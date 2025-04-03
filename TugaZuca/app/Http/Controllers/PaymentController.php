<?php

namespace App\Http\Controllers;

use App\Mail\PaymentConfirmationMail;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            'success_url' => route('payment.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
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

    public function paymentSuccess(Request $request)
    {
        $session_id = $request->query('session_id');

        // Retrieve session from Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($session_id);

        $customer_email = $session->customer_details->email ?? 'default@example.com';

        // Send email to user
        Mail::to($customer_email)->send(new PaymentConfirmationMail($customer_email));

        return view('payment.success', ['session_id' => $session_id]);
    }

    public function paymentCancel()
    {
        return view('payment.cancel');
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        if ($payload['type'] === 'checkout.session.completed') {
            $session = $payload['data']['object'];
            $payment = Payment::where('stripe_session_id', $session['id'])->first();

            if ($payment) {
                $payment->update(['status' => 'success']);

                // Update the related booking to confirmed
                $booking = Booking::find($payment->booking_id);
                if ($booking) {
                    $booking->update(['status' => 'confirmed']);

                    // Mark the package as unavailable
                    $package = Package::find($booking->package_id);
                    if ($package) {
                        $package->update(['is_available' => false]);
                    }

                    // Send confirmation email
                    Mail::to($booking->email)->send(new PaymentConfirmationMail($booking));
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

}
