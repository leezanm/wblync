<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_template_id',
        'version',
        'name',
        'instructions',
        'max_score',
        'status',
        'published_at',
    ];

    protected $casts = [
        'max_score' => 'decimal:2',
        'published_at' => 'datetime',
    ];

    public function assessmentTemplate(): BelongsTo
    {
        return $this->belongsTo(AssessmentTemplate::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(AssessmentSection::class)
            ->orderBy('sort_order');
    }

    public function studentAssessments(): HasMany
    {
        return $this->hasMany(StudentAssessment::class);
    }
}
