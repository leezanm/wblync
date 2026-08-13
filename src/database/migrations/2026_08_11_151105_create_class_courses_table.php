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
        Schema::create('class_courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_room_id')
                ->constrained('class_rooms')
                ->restrictOnDelete();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->restrictOnDelete();

            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            $table->unique([
                'class_room_id',
                'course_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_courses');
    }
};
