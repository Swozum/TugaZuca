<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['booking_id', 'stripe_session_id', 'amount', 'status'];
    
    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
