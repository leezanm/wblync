<?php

namespace App\Models;

use App\Models\WeeklyLogbookSubmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WeeklyLogbookSubmission extends Model
{
    protected $fillable = [
        'uuid',
        'placement_id',
        'week_start_date',
        'week_end_date',
        'status',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'remarks',
    ];

    protected $casts = [
        'week_start_date' => 'date',
        'week_end_date' => 'date',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (WeeklyLogbookSubmission $submission) {
            $submission->uuid ??= (string) Str::uuid();
        });
    }

    public function placement(): BelongsTo
    {
        return $this->belongsTo(
            Placement::class
        );
    }

    public function dailyLogbooks(): HasMany
    {
        return $this->hasMany(
            DailyLogbook::class,
            'weekly_logbook_submission_id'
        );
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }
}
