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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('alias', 50);
            $table->string('title', 200);
            $table->string('image');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('description', 500);
            $table->decimal('price', 15, 2);
            $table->integer('status')->default(1);
            $table->integer('number_of_seats')->default(0);
            $table->string('vehicle_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
