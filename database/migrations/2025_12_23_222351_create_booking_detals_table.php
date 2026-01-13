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
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->string('service_type');
            $table->unsignedBigInteger('service_id');
            $table->decimal('price', 15, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('quantity')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->index(['service_type', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_detals');
    }
};
