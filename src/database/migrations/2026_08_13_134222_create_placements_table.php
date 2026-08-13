<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->restrictOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->restrictOnDelete();

            $table->date('start_date');

            $table->date('end_date');

            $table->enum('status', [
    'Draft',
    'Applied',
    'Approved',
    'Rejected',
    'Active',
    'Completed',
    'Cancelled',
])->default('Draft');

            $table->text('remarks')
                ->nullable();

            $table->timestamps();

            $table->index([
                'student_id',
                'academic_session_id',
            ]);

            $table->index('company_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placements');
    }
};
