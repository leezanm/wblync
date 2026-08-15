<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_logbooks', function (Blueprint $table) {
            $table->foreignId('weekly_logbook_submission_id')
                ->nullable()
                ->after('placement_id')
                ->constrained('weekly_logbook_submissions')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('daily_logbooks', function (Blueprint $table) {
            $table->dropForeign([
                'weekly_logbook_submission_id',
            ]);

            $table->dropColumn(
                'weekly_logbook_submission_id'
            );
        });
    }
};
