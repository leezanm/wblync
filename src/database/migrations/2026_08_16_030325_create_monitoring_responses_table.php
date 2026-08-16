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
        Schema::create('monitoring_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lecturer_monitoring_id')
                ->constrained('lecturer_monitorings')
                ->cascadeOnDelete();

            $table->foreignId('item_id')
                ->constrained('monitoring_form_items')
                ->restrictOnDelete();

            $table->foreignId('option_id')
                ->nullable()
                ->constrained('monitoring_form_options')
                ->nullOnDelete();

            $table->text('answer')->nullable();

            $table->timestamps();

            $table->unique([
                'lecturer_monitoring_id',
                'item_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_responses');
    }
};
