<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'phone', 'package_id', 'type_id', 'status'];
    
    public function type() {
        return $this->belongsTo(Type::class);
    }
    public function package() {
        return $this->belongsTo(Package::class);
    }
    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
