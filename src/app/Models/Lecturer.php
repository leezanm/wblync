<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'staff_no',
        'name',
        'email',
        'phone',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (Lecturer $lecturer) {
            $lecturer->uuid ??= (string) Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function supervisors(): HasMany
    {
        return $this->hasMany(
            Supervisor::class
        );
    }
}
