<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LecturerMonitoring extends Model
{
    protected $fillable = [
        'uuid',
        'supervisor_id',
        'student_id',
        'placement_id',
        'academic_session_id',
        'semester_id',
        'monitoring_form_template_id',
        'monitoring_no',
        'monitoring_date',
        'reported_to',
        'reported_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'monitoring_date' => 'date',
            'reported_to' => 'boolean',
            'reported_at' => 'datetime',
        ];
    }

    // tukar bukan supervisor tapi lecturer sebab lecturer boleh jadi supervisor atau examiner
    public function supervisor(): BelongsTo
    {
        // guna field supervisor_id sebab lecturer boleh jadi supervisor atau examiner
        return $this->belongsTo(
            Lecturer::class,
            'supervisor_id'
        );
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(
            Lecturer::class,
            'supervisor_id'
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class
        );
    }

    public function placement(): BelongsTo
    {
        return $this->belongsTo(
            Placement::class
        );
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(
            AcademicSession::class
        );
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(
            Semester::class
        );
    }

    public function monitoringFormTemplate(): BelongsTo
    {
        return $this->belongsTo(
            MonitoringFormTemplate::class
        );
    }

    public function responses(): HasMany
    {
        return $this->hasMany(
            MonitoringResponse::class,
            'lecturer_monitoring_id'
        );
    }
}
