<?php

namespace App\Models;

use App\Models\LecturerMonitoring;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'student_id',
        'company_id',
        'academic_session_id',
        'start_date',
        'end_date',
        'status',
        'remarks',
        'company_contact_id',
        'industry_supervisor_id',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function companyContact(): BelongsTo
    {
        return $this->belongsTo(CompanyContact::class);
    }

    public function industrySupervisor(): BelongsTo
    {
        return $this->belongsTo(IndustrySupervisor::class);
    }

    public function allowedStatusTransitions(): array
    {
        return [
            'Draft' => [
                'Applied',
            ],

            'Applied' => [
                'Approved',
                'Rejected',
            ],

            'Approved' => [
                'Active',
                'Cancelled',
            ],

            'Active' => [
                'Completed',
                'Cancelled',
            ],

            'Rejected' => [],

            'Completed' => [],

            'Cancelled' => [],
        ];
    }

    public function canChangeStatusTo(string $status): bool
    {
        if ($this->status === $status) {
            return true;
        }

        return in_array(
            $status,
            $this->allowedStatusTransitions()[$this->status] ?? [],
            true
        );
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function dailyLogbooks(): HasMany
    {
        return $this->hasMany(DailyLogbook::class);
    }

    public function weeklyLogbookSubmissions(): HasMany
    {
        return $this->hasMany(
            WeeklyLogbookSubmission::class
        );
    }

    public function lecturerMonitorings(): HasMany
    {
        return $this->hasMany(
            LecturerMonitoring::class
        );
    }
}
