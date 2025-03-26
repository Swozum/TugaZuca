<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function availableSchedules($packageId) {
        return response()->json(Package::where('type_id', $packageId)->where('is_available', true)->get());
    }
}
