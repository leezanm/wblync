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
        Schema::create('assessment_versions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessment_template_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('version')->default(1);

            $table->string('name')->nullable();
            $table->text('instructions')->nullable();

            $table->decimal('max_score', 10, 2)->nullable();

            $table->string('status')->default('draft');

            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            $table->unique([
                'assessment_template_id',
                'version',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_versions');
    }
};
