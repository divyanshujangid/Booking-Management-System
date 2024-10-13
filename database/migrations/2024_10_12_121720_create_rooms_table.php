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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
            $table->string('name');  // Name of the room (e.g., Room 101)
            $table->string('description')->nullable();  // Room description (optional)
            $table->decimal('price', 8, 2)->nullable();  // Price for booking the room (optional)
            $table->integer('capacity');  // Room capacity (number of people)
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('rooms');
}
};
