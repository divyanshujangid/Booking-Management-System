<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();  // Primary key (auto-incrementing)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key for users table
        $table->foreignId('room_id')->constrained()->onDelete('cascade');  // Foreign key for rooms table
        $table->date('booking_date');  // Date of the booking
        $table->time('booking_time');  // Time of the booking
        $table->timestamps();  // Timestamps for created_at and updated_at

        // Add a unique constraint to prevent double booking for the same room at the same time
        $table->unique(['room_id', 'booking_date', 'booking_time']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('bookings');
}
};
