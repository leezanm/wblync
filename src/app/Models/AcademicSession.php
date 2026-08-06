<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AcademicSession extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [

        'code',

        'name',

        'start_date',

        'end_date',

        'status',

        'current',

        'description',

        'created_by'

    ];

    protected $casts = [

        'start_date'=>'date',

        'end_date'=>'date',

        'current'=>'boolean'

    ];

}
