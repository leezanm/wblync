<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonitoringFormSection extends Model
{
    protected $fillable = [
        'template_id',
        'section_no',
        'section_key',
        'title',
        'sort_order',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(
            MonitoringFormTemplate::class,
            'template_id'
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            MonitoringFormItem::class,
            'section_id'
        )->orderBy('sort_order');
    }
}
