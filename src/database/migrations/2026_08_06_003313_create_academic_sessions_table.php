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
        Schema::create('academic_sessions', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('code', 20)->unique();

            $table->string('name');

            $table->date('start_date');

            $table->date('end_date');

            $table->enum('status', [
                'Draft',
                'Active',
                'Closed',
            ])->default('Draft');

            $table->boolean('current')->default(false);

            $table->text('description')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_sessions');
    }
};
