<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class IndustrySupervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'company_id',
        'name',
        'position',
        'email',
        'phone',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (IndustrySupervisor $supervisor) {
            $supervisor->uuid ??= (string) Str::uuid();
        });
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(
            Company::class
        );
    }

}
