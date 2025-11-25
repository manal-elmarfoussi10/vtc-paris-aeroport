<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Pickup fields
            $table->string('pickup_postal')->nullable()->after('pickup_lng');
            $table->string('pickup_city')->nullable()->after('pickup_postal');
            $table->text('pickup_note')->nullable()->after('pickup_city');
            
            // Dropoff fields
            $table->string('dropoff_postal')->nullable()->after('dropoff_lng');
            $table->string('dropoff_city')->nullable()->after('dropoff_postal');
            $table->text('dropoff_note')->nullable()->after('dropoff_city');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'pickup_postal',
                'pickup_city',
                'pickup_note',
                'dropoff_postal',
                'dropoff_city',
                'dropoff_note',
            ]);
        });
    }
};
