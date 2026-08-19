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
        Schema::create('assessment_templates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('code')->nullable();
            $table->string('name');
            $table->text('description')->nullable();

            $table->string('assessor_type');

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique([
                'course_id',
                'name',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_templates');
    }
};
