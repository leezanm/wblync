<?php

namespace App\Models;

use App\Models\AssessmentCriterion;
use App\Models\AssessmentSection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentCriterion extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_section_id',
        'name',
        'description',
        'max_score',
        'sort_order',
        'is_required',
    ];

    protected $casts = [
        'max_score' => 'decimal:2',
        'is_required' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(AssessmentSection::class);
    }

    public function ratingLevels(): HasMany
    {
        return $this->hasMany(AssessmentRatingLevel::class)
            ->orderBy('sort_order');
    }

     public function assessmentVersion(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentVersion::class,
            'assessment_version_id'
        );
    }

    public function criteria(): HasMany
    {
        return $this->hasMany(
            AssessmentCriterion::class,
            'assessment_section_id'
        )->orderBy('sort_order');
    }

      public function assessmentSection(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentSection::class,
            'assessment_section_id'
        );
    }

   
}
