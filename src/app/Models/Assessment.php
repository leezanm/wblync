<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'placement_id',
        'assessment_date',
        'score',
        'grade',
        'status',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'assessment_date' => 'date',
            'score' => 'decimal:2',
        ];
    }

    public function placement(): BelongsTo
    {
        return $this->belongsTo(Placement::class);
    }
}
