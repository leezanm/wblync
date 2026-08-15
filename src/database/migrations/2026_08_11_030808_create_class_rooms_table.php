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
        if (! Schema::hasTable('class_rooms')) {
            Schema::create('class_rooms', function (Blueprint $table) {
                $table->id();

                $table->foreignId('academic_session_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('semester_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('programme_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->string('code', 50);

                $table->string('name', 150);

                $table->boolean('status')->default(true);

                $table->timestamps();

                $table->unique([
                    'academic_session_id',
                    'semester_id',
                    'programme_id',
                    'code',
                ], 'class_rooms_acad_sem_prog_code_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
