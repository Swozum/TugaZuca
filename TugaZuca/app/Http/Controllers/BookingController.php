<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::findOrFail($validated['package_id']);
        if (!$package->is_available) {
            return response()->json(['message' => 'Package not available'], 400);
        }

        $booking = Booking::create($validated + ['status' => 'pending']);
        $package->update(['is_available' => false]);

        return response()->json($booking);
    }
}
