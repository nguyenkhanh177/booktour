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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('alias')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // 💰 Giá
            $table->decimal('price', 15, 2)->comment('Giá / người hoặc combo');

            // 📍 Thông tin
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();

            // 🍽️ Nghiệp vụ
            $table->integer('capacity')->comment('Sức chứa tối đa');
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();

            // 🍱 Phân loại
            $table->string('category')->nullable(); // buffet, hải sản, tiệc cưới...
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
