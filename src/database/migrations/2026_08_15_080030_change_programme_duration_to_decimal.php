<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            'ALTER TABLE programmes MODIFY duration DECIMAL(3,1) UNSIGNED NULL'
        );
    }

    public function down(): void
    {
        DB::statement(
            'ALTER TABLE programmes MODIFY duration TINYINT UNSIGNED NULL'
        );
    }
};

