<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('location');
            $table->string('city');
            $table->string('country');
            $table->decimal('price', 10, 2);
            $table->integer('bedrooms');
            $table->string('type');
            $table->decimal('rating', 2, 1)->nullable();
            $table->json('equipments');
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
