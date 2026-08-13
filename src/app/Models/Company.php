<?php

namespace App\Models;

use App\Models\Placement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'name',
        'registration_no',
        'industry',
        'email',
        'phone',
        'website',
        'address',
        'city',
        'state',
        'postcode',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function placements(): HasMany
    {
        return $this->hasMany(Placement::class);
    }
}
