<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_logbooks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('placement_id')
                ->constrained('placements')
                ->restrictOnDelete();

            $table->date('log_date');

            $table->text('activity');

            $table->text('learning_outcome')->nullable();

            $table->decimal('working_hours', 5, 2)->nullable();

            $table->enum('status', [
                'Draft',
                'Submitted',
                'Approved',
                'Rejected',
            ])->default('Draft');

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index([
                'placement_id',
                'log_date',
            ]);

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logbooks');
    }
};
