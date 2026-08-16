<?php

namespace App\Models;

use App\Models\MonitoringFormItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonitoringFormOption extends Model
{
    protected $fillable = [
        'item_id',
        'option_key',
        'label',
        'description',
        'sort_order',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            MonitoringFormItem::class,
            'item_id'
        );
    }
}
