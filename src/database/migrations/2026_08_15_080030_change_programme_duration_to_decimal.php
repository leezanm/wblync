<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement(
            'ALTER TABLE programmes MODIFY duration DECIMAL(3,1) UNSIGNED NULL'
        );
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement(
            'ALTER TABLE programmes MODIFY duration TINYINT UNSIGNED NULL'
        );
    }
};
