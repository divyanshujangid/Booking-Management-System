<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];  // You can adjust these fields based on your database schema
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
}

