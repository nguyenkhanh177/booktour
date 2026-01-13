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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->string('booking_code')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 15, 2)->default(0);
            $table->string('status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->text('note')->nullable();
            $table->timestamps();

            // Index tối ưu
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
