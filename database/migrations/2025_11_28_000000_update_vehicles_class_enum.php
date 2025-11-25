<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Change enum values for 'class' column to 'eco', 'berline', 'van', 'electric'
        DB::statement("ALTER TABLE vehicles MODIFY COLUMN class ENUM('eco','berline','van','electric') NOT NULL");
    }

    public function down(): void
    {
        // Revert enum values for rollback - back to original
        DB::statement("ALTER TABLE vehicles MODIFY COLUMN class ENUM('sedan','business','van') NOT NULL");
    }
};
