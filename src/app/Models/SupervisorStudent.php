<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SupervisorStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'supervisor_id',
        'student_id',
        'assigned_at',
        'status',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (SupervisorStudent $assignment) {
            $assignment->uuid ??= (string) Str::uuid();

            $assignment->assigned_at ??= now();
        });
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
