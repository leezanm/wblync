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
        if (! Schema::hasTable('student_assessment_scores')) {
            Schema::create('student_assessment_scores', function (Blueprint $table) {
                $table->id();

                $table->foreignId('student_assessment_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('assessment_criterion_id')
                    ->constrained()
                    ->restrictOnDelete();

                $table->foreignId('rating_level_id')
                    ->nullable()
                    ->constrained('assessment_rating_levels')
                    ->restrictOnDelete();

                $table->decimal('score', 10, 2);

                $table->text('remark')->nullable();

                $table->timestamps();

                $table->unique(['student_assessment_id', 'assessment_criterion_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_assessment_scores');
    }
};
