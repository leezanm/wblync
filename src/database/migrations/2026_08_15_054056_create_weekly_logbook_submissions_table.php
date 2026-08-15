<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weekly_logbook_submissions', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('placement_id')
                ->constrained('placements')
                ->cascadeOnDelete();

            $table->date('week_start_date');

            $table->date('week_end_date');

            $table->string('status')
                ->default('Draft');

            $table->timestamp('submitted_at')
                ->nullable();

            $table->timestamp('reviewed_at')
                ->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('remarks')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'placement_id',
                'week_start_date',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'weekly_logbook_submissions'
        );
    }
};
