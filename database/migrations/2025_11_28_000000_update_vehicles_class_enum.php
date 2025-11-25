<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Change enum values for 'class' column to add 'eco' and 'electric'
        DB::statement("ALTER TABLE vehicles MODIFY COLUMN class ENUM('sedan','business','van','eco','electric') NOT NULL");
    }

    public function down(): void
    {
        // Revert enum values for rollback - removing 'eco' and 'electric'
        DB::statement("ALTER TABLE vehicles MODIFY COLUMN class ENUM('sedan','business','van') NOT NULL");
    }
};
