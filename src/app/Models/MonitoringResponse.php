<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonitoringResponse extends Model
{
    protected $fillable = [
        'lecturer_monitoring_id',
        'item_id',
        'option_id',
        'answer',
    ];

    public function monitoring(): BelongsTo
    {
        return $this->belongsTo(
            LecturerMonitoring::class,
            'lecturer_monitoring_id'
        );
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            MonitoringFormItem::class,
            'item_id'
        );
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(
            MonitoringFormOption::class,
            'option_id'
        );
    }
}
