<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('daily_logbooks', 'weekly_summary')) {
            return;
        }

        Schema::table('daily_logbooks', function (Blueprint $table) {
            $table->text('weekly_summary')
                ->nullable()
                ->after('learning_outcome');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('daily_logbooks', 'weekly_summary')) {
            return;
        }

        Schema::table('daily_logbooks', function (Blueprint $table) {
            $table->dropColumn('weekly_summary');
        });
    }
};
