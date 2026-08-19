<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAssessmentScore extends Model
{
    protected $fillable = [
        'student_assessment_id',
        'assessment_criterion_id',
        'rating_level_id',
        'score',
        'remark',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    public function studentAssessment(): BelongsTo
    {
        return $this->belongsTo(
            StudentAssessment::class,
            'student_assessment_id'
        );
    }

    public function assessmentCriterion(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentCriterion::class,
            'assessment_criterion_id'
        );
    }

    public function ratingLevel(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentRatingLevel::class,
            'rating_level_id'
        );
    }
}
