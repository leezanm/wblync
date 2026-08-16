<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonitoringFormItem extends Model
{
    protected $fillable = [
        'section_id',
        'item_key',
        'item_type',
        'label',
        'description',
        'sort_order',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(
            MonitoringFormSection::class,
            'section_id'
        );
    }

    public function options(): HasMany
    {
        return $this->hasMany(
            MonitoringFormOption::class,
            'item_id'
        )->orderBy('sort_order');
    }
}
