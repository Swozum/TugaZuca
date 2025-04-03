@extends('website.base')
@section('main')
<head>
    <title>Payment Successful</title>
</head>
<body>
    <h2>Thank You for Your Payment!</h2>
    <p>Your payment has been successfully processed.</p>
    <p>Confirmation has been sent to: {{ $customer_email }}</p>
    <a href="{{ url('/') }}">Go back to Homepage</a>
</body>
@endsection()