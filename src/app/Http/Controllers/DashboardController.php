<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Assessment;
use App\Models\Company;
use App\Models\DailyLogbook;
use App\Models\Enrollment;
use App\Models\Placement;
use App\Models\Student;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user && $user->hasRole('Student')) {
            $student = $user->student()
                ->with(['classRoom.programme'])
                ->first();

            $currentAcademicSession = AcademicSession::query()
                ->where('current', true)
                ->orderByDesc('start_date')
                ->first();

            if (! $student) {
                return view('dashboard-student', [
                    'student' => null,
                    'currentAcademicSession' => $currentAcademicSession,
                    'enrolledCoursesCount' => 0,
                    'totalLogbooksCount' => 0,
                    'submittedLogbooksCount' => 0,
                    'approvedLogbooksCount' => 0,
                    'assessmentsCount' => 0,
                    'completedAssessmentsCount' => 0,
                    'activePlacement' => null,
                    'recentLogbooks' => collect(),
                ]);
            }

            $placementIds = Placement::query()
                ->where('student_id', $student->id)
                ->pluck('id');

            $activePlacement = Placement::query()
                ->with(['company', 'academicSession', 'companyContact'])
                ->where('student_id', $student->id)
                ->whereIn('status', ['Active', 'Approved', 'Applied', 'Draft'])
                ->orderByRaw("
                    CASE status
                        WHEN 'Active' THEN 1
                        WHEN 'Approved' THEN 2
                        WHEN 'Applied' THEN 3
                        WHEN 'Draft' THEN 4
                        ELSE 5
                    END
                ")
                ->orderByDesc('start_date')
                ->first();

            $recentLogbooks = DailyLogbook::query()
                ->with(['placement.company'])
                ->whereIn('placement_id', $placementIds)
                ->orderByDesc('log_date')
                ->limit(5)
                ->get();

            return view('dashboard-student', [
                'student' => $student,
                'currentAcademicSession' => $currentAcademicSession,
                'enrolledCoursesCount' => Enrollment::query()
                    ->where('student_id', $student->id)
                    ->count(),
                'totalLogbooksCount' => DailyLogbook::query()
                    ->whereIn('placement_id', $placementIds)
                    ->count(),
                'submittedLogbooksCount' => DailyLogbook::query()
                    ->whereIn('placement_id', $placementIds)
                    ->where('status', 'Submitted')
                    ->count(),
                'approvedLogbooksCount' => DailyLogbook::query()
                    ->whereIn('placement_id', $placementIds)
                    ->where('status', 'Approved')
                    ->count(),
                'assessmentsCount' => Assessment::query()
                    ->whereIn('placement_id', $placementIds)
                    ->count(),
                'completedAssessmentsCount' => Assessment::query()
                    ->whereIn('placement_id', $placementIds)
                    ->where('status', 'Completed')
                    ->count(),
                'activePlacement' => $activePlacement,
                'recentLogbooks' => $recentLogbooks,
            ]);
        }

        $academicSessionsCount = AcademicSession::count();
        $studentsCount = Student::count();
        $companiesCount = Company::count();
        $pendingLogbooksCount = DailyLogbook::query()
            ->where('status', 'Submitted')
            ->count();

        $currentAcademicSession = AcademicSession::query()
            ->where('current', true)
            ->orderByDesc('start_date')
            ->first();

        return view('dashboard', [
            'academicSessionsCount' => $academicSessionsCount,
            'studentsCount' => $studentsCount,
            'companiesCount' => $companiesCount,
            'pendingLogbooksCount' => $pendingLogbooksCount,
            'currentAcademicSession' => $currentAcademicSession,
        ]);
    }
}
