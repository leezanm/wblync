<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('daily_logbooks', 'weekly_logbook_submission_id')) {
            Schema::table('daily_logbooks', function (Blueprint $table) {
                $table->foreignId('weekly_logbook_submission_id')
                    ->nullable()
                    ->after('placement_id')
                    ->constrained('weekly_logbook_submissions')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('daily_logbooks', 'weekly_logbook_submission_id')) {
            return;
        }

        $foreignKeyExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'daily_logbooks')
            ->where('COLUMN_NAME', 'weekly_logbook_submission_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();

        Schema::table('daily_logbooks', function (Blueprint $table) use ($foreignKeyExists) {
            if ($foreignKeyExists) {
                $table->dropForeign(['weekly_logbook_submission_id']);
            }

            $table->dropColumn('weekly_logbook_submission_id');
        });
    }
};

