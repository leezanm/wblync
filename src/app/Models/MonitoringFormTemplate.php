<?php

namespace App\Models;

use App\Models\LecturerMonitoring;
use App\Models\MonitoringFormSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonitoringFormTemplate extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'version',
        'status',
        'created_by',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(
            MonitoringFormSection::class,
            'template_id'
        )->orderBy('sort_order');
    }

    public function lecturerMonitorings(): HasMany
    {
        return $this->hasMany(
            LecturerMonitoring::class
        );
    }
}
