<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('name');  // Name of the room
            $table->string('description')->nullable();  // Room description
            $table->decimal('price', 8, 2)->nullable();  // Price for booking
            $table->integer('capacity');  // Number of people the room can accommodate
            $table->timestamps();  // Created at & updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
