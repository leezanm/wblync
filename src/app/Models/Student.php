<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'class_room_id',
        'student_no',
        'name',
        'ic_no',
        'email',
        'phone',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Student $student) {
            if (! $student->uuid) {
                $student->uuid = (string) Str::uuid();
            }
        });
    }

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

  

    public function placements(): HasMany
    {
        return $this->hasMany(Placement::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function supervisorAssignments(): HasMany
    {
        return $this->hasMany(SupervisorStudent::class);
    }

    public function lecturerMonitorings(): HasMany
    {
        return $this->hasMany(
            LecturerMonitoring::class
        );
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(StudentEnrollment::class);
    }
}
