<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'lecturer_id',
        'academic_session_id',
        'semester_id',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (Supervisor $supervisor) {
            $supervisor->uuid ??= (string) Str::uuid();
        });
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(SupervisorStudent::class);
    }

    public function monitorings(): HasMany
    {
        return $this->hasMany(
            LecturerMonitoring::class
        );
    }
}
