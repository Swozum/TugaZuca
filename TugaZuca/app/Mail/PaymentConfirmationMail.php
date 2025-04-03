<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer_email;

    public function __construct($customer_email)
    {
        $this->customer_email = $customer_email;
    }

    public function build()
    {
        return $this->subject('Payment Confirmation')
                    ->view('emails.payment_confirmation')
                    ->with(['customer_email' => $this->customer_email]);
    }
}
