@extends('website.base')

@section('main')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-center text-lime-600 mb-6">
        Pacotes de {{ $type->name }}
    </h2>

    <!-- Booking Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg text-center mb-8">
        <h3 class="text-xl font-semibold text-gray-800">Preencha seus dados</h3>
        <form id="booking-form" method="POST">
            @csrf
            <input type="hidden" name="type_id" id="type_id" value="{{ $type->id }}">
            <input type="hidden" name="package_id" id="selected-package" required>

            <input type="text" name="name" id="name" placeholder="Seu Nome" required 
                class="block mt-2 w-full p-2 border rounded-lg">
            <input type="email" name="email" id="email" placeholder="Seu Email" required 
                class="block mt-2 w-full p-2 border rounded-lg">
            <input type="text" name="phone" id="phone" placeholder="Seu Telefone" required 
                class="block mt-2 w-full p-2 border rounded-lg">

            <!-- Packages Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md-grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($type->packages as $package)
                @if($package->is_available)
                    <div 
                        class="package-option bg-white p-6 rounded-lg shadow-lg text-center cursor-pointer border-2 border-transparent"
                        data-package-id="{{ $package->id }}"
                        onclick="selectPackage(this)">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $package->week_days }}</h3>
                        <p class="text-gray-600 mt-2">{{ $package->time }}</p>
                        <p class="text-lg font-bold text-lime-600 mt-2">€{{ number_format($package->type->price, 2) }}</p>
                    </div>
                @endif
                @endforeach
            </div>

            <button type="button" onclick="createBooking()" 
                class="mt-4 bg-lime-500 text-white px-4 py-2 rounded-lg hover:bg-lime-600 transition">
                Reservar e Pagar
            </button>
        </form>
    </div>
</div>

<!-- JavaScript for Clickable Selection & Payment -->
<script>
    function selectPackage(element) {
        // Remove selection from all packages
        document.querySelectorAll('.package-option').forEach(package => {
            package.classList.remove('border-lime-500'); // Remove highlight
            package.classList.add('border-transparent'); // Reset border
        });

        // Mark the selected package
        element.classList.remove('border-transparent');
        element.classList.add('border-lime-500');

        // Store the selected package ID
        let packageId = element.getAttribute("data-package-id");
        document.getElementById("selected-package").value = packageId;
    }

    function createBooking() {
    let form = document.getElementById("booking-form");
    let packageId = document.getElementById("selected-package").value;

    if (!packageId) {
        alert("Selecione um pacote antes de prosseguir.");
        return;
    }

    const bookingData = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        type_id: document.getElementById("type_id").value,
        package_id: packageId
    };

    fetch("{{ url('/api/bookings') }}", {  
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(bookingData)
    })
    .then(response => response.json())
    .then(data => {
        return fetch("/api/payments/session", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ booking_id: data.id })
        });
    })
    .then(response => response.json())
    .then(data => {
        window.location.href = data.url; // Redirects user to Stripe Checkout
    });
}



</script>
@endsection
