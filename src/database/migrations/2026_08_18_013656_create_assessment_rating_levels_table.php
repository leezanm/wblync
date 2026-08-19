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
        if (! Schema::hasTable('assessment_rating_levels')) {
            Schema::create('assessment_rating_levels', function (Blueprint $table) {
                $table->id();

                $table->foreignId('assessment_criterion_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->decimal('score', 10, 2);

                $table->string('label');

                $table->text('description')->nullable();

                $table->unsignedInteger('sort_order')->default(0);

                $table->timestamps();

                $table->unique([
                    'assessment_criterion_id',
                    'score',
                ]);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_rating_levels');
    }
};
