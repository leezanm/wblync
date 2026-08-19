<?php

namespace App\Models;

use App\Models\AssessmentVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentRatingLevel extends Model
{
    protected $fillable = [
        'assessment_criterion_id',
        'score',
        'label',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    public function assessmentCriterion(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentCriterion::class
        );
    }


}
