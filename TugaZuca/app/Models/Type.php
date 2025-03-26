<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'sessions_per_month', 'price', 'is_active'];
    
    public function packages() {
        return $this->hasMany(Package::class);
    }
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
