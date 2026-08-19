<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentAssessment extends Model
{
    use HasFactory;

    public const ASSESSOR_INDUSTRY_MENTOR = 'INDUSTRY_MENTOR';

    protected $fillable = [
        'uuid',
        'student_id',
        'student_enrollment_id',
        'enrollment_id',
        'assessment_version_id',
        'assessor_type',
        'assessor_id',
        'assessed_at',
        'status',
        'total_score',
        'percentage',
        'remarks',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
        'total_score' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function studentEnrollment(): BelongsTo
    {
        return $this->belongsTo(
            StudentEnrollment::class
        );
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function assessmentVersion(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentVersion::class
        );
    }

    public function assessor(): BelongsTo
    {
        return $this->belongsTo(
            IndustrySupervisor::class,
            'assessor_id'
        );
    }

    public function scores(): HasMany
    {
        return $this->hasMany(
            StudentAssessmentScore::class
        );
    }
}
