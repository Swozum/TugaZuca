@extends('website.base')
@section('main')
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h2>Payment Confirmation</h2>
    <p>Dear {{ $booking->name }},</p>
    <p>Thank you for your payment! Your class booking has been confirmed.</p>
    <p><strong>Package:</strong> {{ $booking->package->week_days }} at {{ $booking->package->time }}</p>
    <p><strong>Amount Paid:</strong> €{{ number_format($booking->type->price, 2) }}</p>
    <p>We look forward to seeing you!</p>
</body>
@endsection()