@extends('website.base')
@section('main')
<head>
    <title>Payment Cancelled</title>
</head>
<body>
    <h2>Payment Cancelled</h2>
    <p>Your payment was not completed.</p>
    <a href="{{ url('/') }}">Try Again</a>
</body>
@endsection()