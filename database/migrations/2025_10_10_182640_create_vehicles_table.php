<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();            // sedan, business, van
            $table->string('name');                      // "Sedan", "Business", "Van"
            $table->enum('class', ['sedan','business','van']); // vehicle class
            $table->unsignedTinyInteger('capacity_pax'); // passengers
            $table->unsignedTinyInteger('capacity_luggage')->default(0);
            $table->decimal('base_rate', 10, 2)->default(0);
            $table->decimal('per_km', 10, 2)->nullable();
            $table->decimal('per_min', 10, 2)->nullable();
            $table->string('image')->nullable();         // path to photo
            $table->text('description')->nullable();     // vehicle description
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};