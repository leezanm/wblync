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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('placement_id')
                ->constrained('placements')
                ->restrictOnDelete();

            $table->date('assessment_date');

            $table->decimal('score', 5, 2)->nullable();

            $table->string('grade', 10)->nullable();

            $table->enum('status', [
                'Draft',
                'Submitted',
                'Completed',
            ])->default('Draft');

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index('placement_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
