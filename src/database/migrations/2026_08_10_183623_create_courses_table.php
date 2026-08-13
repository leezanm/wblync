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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('programme_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('code', 50);

            $table->string('name', 150);

            $table->unsignedTinyInteger('credit_hours');

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique([
                'programme_id',
                'code',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
