<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'description', 'price', 'capacity'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
class Booking extends Model
{
    protected $fillable = ['user_id', 'room_id', 'booking_date', 'booking_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
