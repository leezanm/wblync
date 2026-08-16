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
        Schema::create('monitoring_form_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('section_id')
                ->constrained('monitoring_form_sections')
                ->cascadeOnDelete();

            $table->string('item_key');

            $table->string('item_type');

            $table->text('label');

            $table->text('description')->nullable();

            $table->unsignedInteger('sort_order');

            $table->timestamps();

            $table->unique([
                'section_id',
                'item_key',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_form_items');
    }
};
