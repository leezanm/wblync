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
        Schema::create('lecturer_monitorings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('supervisor_id')
                ->constrained('supervisors')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('placement_id')
                ->nullable()
                ->constrained('placements')
                ->nullOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->foreignId('semester_id')
                ->constrained('semesters')
                ->cascadeOnDelete();

            $table->foreignId('monitoring_form_template_id')
                ->constrained('monitoring_form_templates')
                ->restrictOnDelete();

            $table->unsignedTinyInteger('monitoring_no');

            $table->date('monitoring_date');

            $table->boolean('reported_to')->default(false);

            $table->time('reported_at')->nullable();

            $table->string('status')->default('Draft');

            $table->timestamps();

            $table->unique([
                'supervisor_id',
                'student_id',
                'academic_session_id',
                'semester_id',
                'monitoring_no',
            ], 'lecturer_monitorings_sup_stu_sess_sem_mon_no_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer_monitorings');
    }
};
