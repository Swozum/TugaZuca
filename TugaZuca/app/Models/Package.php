<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['type_id', 'week_days', 'time', 'is_available'];
    
    public function type() {
        return $this->belongsTo(Type::class);
    }
    public function booking() {
        return $this->hasOne(Booking::class);
    }
}
