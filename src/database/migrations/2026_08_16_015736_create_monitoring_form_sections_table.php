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
        Schema::create('monitoring_form_sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('template_id')
                ->constrained('monitoring_form_templates')
                ->cascadeOnDelete();

            $table->unsignedInteger('section_no');

            $table->string('section_key');
            $table->string('title');

            $table->unsignedInteger('sort_order');

            $table->timestamps();

            $table->unique([
                'template_id',
                'section_key',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_form_sections');
    }
};
