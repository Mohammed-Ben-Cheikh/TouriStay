<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ville_id')->constrained('villes')->onDelete('cascade'); // Nouvelle relation
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->integer('bedrooms');
            $table->integer('max_guests')->default(4);
            $table->string('type');
            $table->decimal('rating', 2, 1)->nullable();
            $table->integer('reviews_count')->default(0);
            $table->json('equipments')->nullable();
            $table->boolean('is_available')->default(true);
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();
            $table->integer('minimum_nights')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
