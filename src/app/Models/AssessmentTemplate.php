<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentTemplate extends Model
{
    protected $fillable = [
        'uuid',
        'course_id',
        'code',
        'name',
        'description',
        'assessor_type',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(AssessmentVersion::class);
    }
}
