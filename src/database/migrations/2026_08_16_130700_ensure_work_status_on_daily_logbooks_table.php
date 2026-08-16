<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('daily_logbooks', 'work_status')) {
            Schema::table('daily_logbooks', function (Blueprint $table) {
                $table->string('work_status', 50)
                    ->default('Working')
                    ->after('log_date');
            });
        }

        DB::table('daily_logbooks')
            ->whereNull('work_status')
            ->update([
                'work_status' => 'Working',
            ]);
    }

    public function down(): void
    {
        if (! Schema::hasColumn('daily_logbooks', 'work_status')) {
            return;
        }

        Schema::table('daily_logbooks', function (Blueprint $table) {
            $table->dropColumn('work_status');
        });
    }
};
