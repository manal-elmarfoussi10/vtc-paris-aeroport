<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // who created / who is the customer
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();   // if logged in
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();

            // contact details fallback (for guest bookings)
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();

            // ride details
            $table->string('pickup_address');
            $table->decimal('pickup_lat', 10, 7)->nullable();
            $table->decimal('pickup_lng', 10, 7)->nullable();

            $table->string('dropoff_address');
            $table->decimal('dropoff_lat', 10, 7)->nullable();
            $table->decimal('dropoff_lng', 10, 7)->nullable();

            $table->dateTime('pickup_time');

            $table->unsignedTinyInteger('pax')->default(1);
            $table->unsignedTinyInteger('luggage')->default(0);

            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->nullOnDelete();

            // extras
            $table->unsignedTinyInteger('child_seat_count')->default(0);
            $table->boolean('meet_greet')->default(false);
            $table->string('flight_number')->nullable();

            // pricing
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency', 3)->default('EUR');

            // status: new|confirmed|completed|cancelled
            $table->string('status')->default('new');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['pickup_time', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};