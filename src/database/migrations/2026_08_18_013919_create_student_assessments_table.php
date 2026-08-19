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
        if (! Schema::hasTable('student_assessments')) {
            Schema::create('student_assessments', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();

                $table->foreignId('student_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('assessment_version_id')
                    ->constrained()
                    ->restrictOnDelete();

                $table->string('assessor_type');

                $table->foreignId('assessor_id');

                $table->timestamp('assessed_at')->nullable();

                $table->string('status')->default('draft');

                $table->decimal('total_score', 10, 2)->nullable();

                $table->decimal('percentage', 10, 2)->nullable();

                $table->text('remarks')->nullable();

                $table->timestamps();

                $table->index(['student_id', 'assessment_version_id']);
                $table->index(['assessor_type', 'assessor_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_assessments');
    }
};
