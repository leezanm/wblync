<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyLogbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'placement_id',
        'log_date',
        'activity',
        'learning_outcome',
        'working_hours',
        'status',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'log_date' => 'date',
            'working_hours' => 'decimal:2',
        ];
    }

    public function placement(): BelongsTo
    {
        return $this->belongsTo(Placement::class);
    }
}
