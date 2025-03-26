@extends('website.base')
@section('main')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-center text-lime-600 mb-6">
        Pacotes de {{ $type->name }}
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($type->packages as $package)
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-semibold text-gray-800">{{ $package->week_days }}</h3>
                <p class="text-gray-600 mt-2">{{ $package->time }} Lisbon Time</p>
                <p class="text-lg font-bold text-lime-600 mt-2">€{{ number_format($package->type->price, 2) }}</p>
                <a href="#" class="mt-4 inline-block bg-lime-500 text-white px-4 py-2 rounded-lg hover:bg-lime-600 transition">
                    Escolher Pacote
                </a>
            </div>
        @endforeach
    </div>
</div>
<script>
    function createBooking(packageId) {
        let form = document.getElementById(`booking-form-${packageId}`);
        let formData = new FormData(form);

        fetch("{{ url('/api/bookings') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.id) {
                initiatePayment(data.id);
            }
        })
        .catch(error => console.error("Error:", error));
    }

    function initiatePayment(bookingId) {
        fetch("{{ url('/api/payments/session') }}", {
            method: "POST",
            body: JSON.stringify({ booking_id: bookingId }),
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                window.location.href = data.url; // Redirect to Stripe Checkout
            }
        })
        .catch(error => console.error("Error:", error));
    }
</script>
@endsection()