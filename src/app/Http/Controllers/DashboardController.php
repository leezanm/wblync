<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Assessment;
use App\Models\Company;
use App\Models\DailyLogbook;
use App\Models\Enrollment;
use App\Models\IndustrySupervisor;
use App\Models\Lecturer;
use App\Models\LecturerMonitoring;
use App\Models\MonitoringFormTemplate;
use App\Models\Placement;
use App\Models\Student;
use App\Models\SupervisorStudent;
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
                ->with(['company', 'academicSession', 'companyContact', 'industrySupervisor'])
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

        if ($user && $user->hasAnyRole(['Industry Mentor', 'Industry Supervisor'])) {
            $industrySupervisor = $user->industrySupervisor;
            $currentAcademicSession = AcademicSession::query()
                ->where('current', true)
                ->orderByDesc('start_date')
                ->first();

            if (! $industrySupervisor) {
                return view('dashboard-mentor', [
                    'industrySupervisor' => null,
                    'currentAcademicSession' => $currentAcademicSession,
                    'company' => null,
                    'supervisedStudentsCount' => 0,
                    'activePlacementsCount' => 0,
                    'pendingApprovalsCount' => 0,
                    'reviewedSubmissionsCount' => 0,
                    'recentSubmissions' => collect(),
                    'activePlacements' => collect(),
                ]);
            }

            $supervisorPlacements = Placement::query()
                ->where('industry_supervisor_id', $industrySupervisor->id);

            $activePlacements = (clone $supervisorPlacements)
                ->where('status', 'Active')
                ->with([
                    'student',
                    'company',
                ])
                ->latest('start_date')
                ->limit(8)
                ->get();

            $placementIds = (clone $supervisorPlacements)
                ->pluck('id');

            $recentSubmissions = DailyLogbook::query()
                ->whereIn('placement_id', $placementIds)
                ->whereIn('status', ['Submitted', 'Approved', 'Rejected'])
                ->with([
                    'placement.student',
                    'placement.company',
                ])
                ->latest('log_date')
                ->limit(6)
                ->get();

            return view('dashboard-mentor', [
                'industrySupervisor' => $industrySupervisor,
                'currentAcademicSession' => $currentAcademicSession,
                'company' => IndustrySupervisor::query()
                    ->whereKey($industrySupervisor->id)
                    ->with('company')
                    ->first()?->company,
                'supervisedStudentsCount' => (clone $supervisorPlacements)
                    ->select('student_id')
                    ->distinct()
                    ->count(),
                'activePlacementsCount' => (clone $supervisorPlacements)
                    ->where('status', 'Active')
                    ->count(),
                'pendingApprovalsCount' => DailyLogbook::query()
                    ->whereIn('placement_id', $placementIds)
                    ->where('status', 'Submitted')
                    ->count(),
                'reviewedSubmissionsCount' => DailyLogbook::query()
                    ->whereIn('placement_id', $placementIds)
                    ->whereIn('status', ['Approved', 'Rejected'])
                    ->count(),
                'recentSubmissions' => $recentSubmissions,
                'activePlacements' => $activePlacements,
            ]);
        }

        if ($user && $user->hasRole('Lecturer')) {
            $lecturer = $user->lecturer;
            $currentAcademicSession = AcademicSession::query()
                ->where('current', true)
                ->orderByDesc('start_date')
                ->first();

            if (! $lecturer) {
                return view('dashboard-lecturer', [
                    'lecturer' => null,
                    'currentAcademicSession' => $currentAcademicSession,
                    'assignedStudentsCount' => 0,
                    'activePlacementsCount' => 0,
                    'pendingLogbookReviewsCount' => 0,
                    'completedMonitoringsCount' => 0,
                    'monitoringVisitSummary' => collect([1, 2, 3])->map(function ($visitNo) {
                        return [
                            'visit_no' => $visitNo,
                            'total' => 0,
                            'bar_percent' => 0,
                        ];
                    }),
                    'recentDailyLogbooks' => collect(),
                    'assignedStudents' => collect(),
                ]);
            }

            $assignedStudentsQuery = SupervisorStudent::query()
                ->whereHas('supervisor', function ($query) use ($lecturer) {
                    $query->where('lecturer_id', $lecturer->id);
                })
                ->where('status', 'Active');

            $assignedStudentIds = (clone $assignedStudentsQuery)
                ->select('student_id')
                ->distinct()
                ->pluck('student_id');

            $activePlacementIds = Placement::query()
                ->whereIn('student_id', $assignedStudentIds)
                ->where('status', 'Active')
                ->pluck('id');

            $recentDailyLogbooks = DailyLogbook::query()
                ->whereIn('placement_id', $activePlacementIds)
                ->whereIn('status', ['Submitted', 'Approved', 'Rejected'])
                ->with([
                    'placement.student',
                    'placement.company',
                ])
                ->latest('log_date')
                ->limit(6)
                ->get();

            $assignedStudents = Student::query()
                ->whereIn('id', $assignedStudentIds)
                ->with([
                    'placements' => function ($query) {
                        $query
                            ->where('status', 'Active')
                            ->with('company')
                            ->latest('start_date');
                    },
                ])
                ->orderBy('name')
                ->limit(8)
                ->get();

            $assignedStudentsCount = $assignedStudentIds->count();

            $visitTotals = LecturerMonitoring::query()
                ->where('supervisor_id', $lecturer->id)
                ->whereIn('monitoring_no', [1, 2, 3])
                ->selectRaw('monitoring_no, COUNT(*) as total')
                ->groupBy('monitoring_no')
                ->pluck('total', 'monitoring_no');

            $maxVisitTotal = (int) $visitTotals->max();

            $monitoringVisitSummary = collect([1, 2, 3])->map(function ($visitNo) use ($visitTotals, $maxVisitTotal) {
                $total = (int) ($visitTotals[$visitNo] ?? 0);
                $barPercent = $maxVisitTotal > 0
                    ? (int) round(($total / $maxVisitTotal) * 100)
                    : 0;

                return [
                    'visit_no' => $visitNo,
                    'total' => $total,
                    'bar_percent' => $barPercent,
                ];
            });

            return view('dashboard-lecturer', [
                'lecturer' => $lecturer,
                'currentAcademicSession' => $currentAcademicSession,
                'assignedStudentsCount' => $assignedStudentsCount,
                'activePlacementsCount' => $activePlacementIds->count(),
                'pendingLogbookReviewsCount' => DailyLogbook::query()
                    ->whereIn('placement_id', $activePlacementIds)
                    ->where('status', 'Submitted')
                    ->count(),
                'completedMonitoringsCount' => LecturerMonitoring::query()
                    ->where('supervisor_id', $lecturer->id)
                    ->where('status', 'Completed')
                    ->count(),
                'monitoringVisitSummary' => $monitoringVisitSummary,
                'recentDailyLogbooks' => $recentDailyLogbooks,
                'assignedStudents' => $assignedStudents,
            ]);
        }

        $academicSessionsCount = AcademicSession::count();
        $studentsCount = Student::count();
        $activeStudentsCount = Student::query()
            ->where('status', true)
            ->count();
        $companiesCount = Company::count();
        $lecturersCount = Lecturer::count();
        $industryMentorsCount = IndustrySupervisor::query()
            ->where('status', true)
            ->count();
        $activePlacementsCount = Placement::query()
            ->where('status', 'Active')
            ->count();
        $pendingLogbooksCount = DailyLogbook::query()
            ->where('status', 'Submitted')
            ->count();

        $currentAcademicSession = AcademicSession::query()
            ->where('current', true)
            ->orderByDesc('start_date')
            ->first();

        $placementStatusCounts = Placement::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $placementStatusSummary = collect([
            'Draft',
            'Applied',
            'Approved',
            'Active',
            'Completed',
            'Rejected',
            'Cancelled',
        ])->map(function ($status) use ($placementStatusCounts) {
            return [
                'status' => $status,
                'total' => (int) ($placementStatusCounts[$status] ?? 0),
            ];
        });

        $monitoringVisitCounts = LecturerMonitoring::query()
            ->whereIn('monitoring_no', [1, 2, 3])
            ->selectRaw('monitoring_no, COUNT(*) as total')
            ->groupBy('monitoring_no')
            ->pluck('total', 'monitoring_no');

        $maxMonitoringVisitTotal = (int) $monitoringVisitCounts->max();

        $monitoringVisitSummary = collect([1, 2, 3])->map(function ($visitNo) use ($monitoringVisitCounts, $maxMonitoringVisitTotal) {
            $total = (int) ($monitoringVisitCounts[$visitNo] ?? 0);

            return [
                'visit_no' => $visitNo,
                'total' => $total,
                'bar_percent' => $maxMonitoringVisitTotal > 0
                    ? (int) round(($total / $maxMonitoringVisitTotal) * 100)
                    : 0,
            ];
        });

        $activeMonitoringTemplate = MonitoringFormTemplate::query()
            ->where('status', 'Active')
            ->latest('id')
            ->first();

        $recentSubmittedLogbooks = DailyLogbook::query()
            ->where('status', 'Submitted')
            ->with([
                'placement.student',
                'placement.company',
            ])
            ->latest('log_date')
            ->limit(6)
            ->get();

        $recentMonitorings = LecturerMonitoring::query()
            ->with([
                'student',
                'placement.company',
            ])
            ->latest('monitoring_date')
            ->limit(6)
            ->get();

        return view('dashboard', [
            'academicSessionsCount' => $academicSessionsCount,
            'studentsCount' => $studentsCount,
            'activeStudentsCount' => $activeStudentsCount,
            'companiesCount' => $companiesCount,
            'lecturersCount' => $lecturersCount,
            'industryMentorsCount' => $industryMentorsCount,
            'activePlacementsCount' => $activePlacementsCount,
            'pendingLogbooksCount' => $pendingLogbooksCount,
            'currentAcademicSession' => $currentAcademicSession,
            'placementStatusSummary' => $placementStatusSummary,
            'monitoringVisitSummary' => $monitoringVisitSummary,
            'activeMonitoringTemplate' => $activeMonitoringTemplate,
            'recentSubmittedLogbooks' => $recentSubmittedLogbooks,
            'recentMonitorings' => $recentMonitorings,
        ]);
    }
}
