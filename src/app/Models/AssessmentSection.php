<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_version_id',
        'name',
        'description',
        'sort_order',
    ];

    public function assessmentVersion(): BelongsTo
    {
        return $this->belongsTo(AssessmentVersion::class);
    }

    public function criteria(): HasMany
    {
        return $this->hasMany(AssessmentCriterion::class)
            ->orderBy('sort_order');
    }
}
