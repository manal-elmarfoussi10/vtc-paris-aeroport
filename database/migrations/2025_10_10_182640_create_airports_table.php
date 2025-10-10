<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();          // cdg, ory, bva
            $table->string('code')->nullable();        // CDG, ORY, BVA
            $table->string('name');
            $table->string('seo_title')->nullable();
            $table->text('seo_text')->nullable();      // 300-500 words
            $table->decimal('base_rate_to_paris', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};