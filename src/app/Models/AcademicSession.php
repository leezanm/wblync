<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicSession extends Model
{
    use HasUuids;
    use SoftDeletes;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    protected $fillable = [

        'code',

        'name',

        'start_date',

        'end_date',

        'status',

        'current',

        'description',

        'created_by',

    ];

    protected $casts = [

        'start_date' => 'date',

        'end_date' => 'date',

        'current' => 'boolean',

    ];

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function classRooms(): HasMany
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function placements(): HasMany
    {
        return $this->hasMany(Placement::class);
    }
}
