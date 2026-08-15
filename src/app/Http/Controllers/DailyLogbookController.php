<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailyLogbookRequest;
use App\Models\DailyLogbook;
use App\Models\Placement;
use App\Models\WeeklyLogbookSubmission;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DailyLogbookController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $studentUser = $user?->hasRole('Student')
            ? $user?->student
            : null;

        $isIndustryMentor = $user?->hasAnyRole([
            'Industry Supervisor',
            'Industry Mentor',
        ]);

        $industrySupervisorUser = $isIndustryMentor
            ? $user?->industrySupervisor
            : null;

        /*
        |--------------------------------------------------------------------------
        | STUDENT VIEW
        |--------------------------------------------------------------------------
        |
        | Student sees their current active placement and current week's
        | daily logbooks.
        |
        */

        if ($studentUser) {

            abort_unless(
                $studentUser,
                403
            );

            $placement = $studentUser
                ->placements()
                ->with([
                    'company',
                    'industrySupervisor',
                ])
                ->where('status', 'Active')
                ->latest('start_date')
                ->first();

            /*
            |--------------------------------------------------------------------------
            | No Active Placement
            |--------------------------------------------------------------------------
            */

            if (! $placement) {
                return view(
                    'daily-logbooks.index',
                    [
                        'placement' => null,
                        'weekStart' => now()->startOfWeek(),
                        'weekEnd' => now()->endOfWeek(),
                        'dailyLogbooks' => collect(),
                        'weeklySubmission' => null,
                        'logbooks' => collect(),
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Current Week
            |--------------------------------------------------------------------------
            */

            $date = $request->filled('date')
                ? $request->date('date')
                : now();

            $weekStart = $date
                ->copy()
                ->startOfWeek();

            $weekEnd = $date
                ->copy()
                ->endOfWeek();

            /*
            |--------------------------------------------------------------------------
            | Daily Logbooks
            |--------------------------------------------------------------------------
            */

            $dailyLogbooks = $placement
                ->dailyLogbooks()
                ->whereBetween('log_date', [
                    $weekStart->toDateString(),
                    $weekEnd->toDateString(),
                ])
                ->orderBy('log_date')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Weekly Submission
            |--------------------------------------------------------------------------
            */

            $weeklySubmission = $placement
                ->weeklyLogbookSubmissions()
                ->whereDate(
                    'week_start_date',
                    $weekStart->toDateString()
                )
                ->first();

            return view(
                'daily-logbooks.index',
                compact(
                    'placement',
                    'weekStart',
                    'weekEnd',
                    'dailyLogbooks',
                    'weeklySubmission'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | INDUSTRY SUPERVISOR / ADMIN VIEW
        |--------------------------------------------------------------------------
        */

        $query = DailyLogbook::query()
            ->with([
                'placement.student',
                'placement.company',
                'placement.industrySupervisor',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Industry Supervisor
        |--------------------------------------------------------------------------
        */

        if ($isIndustryMentor && ! $industrySupervisorUser) {
            abort(
                403,
                'Industry mentor profile not found.'
            );
        }

        if ($industrySupervisorUser) {

            $query->whereHas(
                'placement',
                function ($query) use ($industrySupervisorUser) {

                    $query->where(
                        'industry_supervisor_id',
                        $industrySupervisorUser->id
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Admin / Other Users - Student Filter
        |--------------------------------------------------------------------------
        */

        elseif ($request->filled('student_id')) {

            $query->whereHas(
                'placement',
                function ($query) use ($request) {

                    $query->where(
                        'student_id',
                        $request->integer('student_id')
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request
                ->string('search')
                ->trim();

            $query->whereHas(
                'placement',
                function ($query) use ($search) {

                    $query->whereHas(
                        'student',
                        function ($query) use ($search) {

                            $query
                                ->where(
                                    'student_no',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );
                        }
                    );

                    $query->orWhereHas(
                        'company',
                        function ($query) use ($search) {

                            $query
                                ->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'code',
                                    'like',
                                    "%{$search}%"
                                );
                        }
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Logbook Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Date From
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {

            $query->whereDate(
                'log_date',
                '>=',
                $request
                    ->date('date_from')
                    ->toDateString()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Date To
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_to')) {

            $query->whereDate(
                'log_date',
                '<=',
                $request
                    ->date('date_to')
                    ->toDateString()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $logbooks = $query
            ->latest('log_date')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Legacy / Supervisor View
        |--------------------------------------------------------------------------
        */

        return view(
            'daily-logbooks.index',
            [
                'logbooks' => $logbooks,

                'placement' => null,

                'weekStart' => now()->startOfWeek(),

                'weekEnd' => now()->endOfWeek(),

                'dailyLogbooks' => collect(),

                'weeklySubmission' => null,
            ]
        );
    }

    public function create(Request $request): View
    {
        $student = $request->user()->student;

        abort_unless($student, 403);

        $placement = $student
            ->placements()
            ->with([
                'student.classRoom.programme',
                'company',
                'companyContact',
                'industrySupervisor',
                'academicSession',
            ])
            ->where('status', 'Active')
            ->latest('start_date')
            ->firstOrFail();

        return view(
            'daily-logbooks.create',
            compact('placement')
        );
    }

    public function store(
        DailyLogbookRequest $request
    ): RedirectResponse {

        $placement = Placement::findOrFail(
            $request->integer('placement_id')
        );

        if (! in_array(
            $placement->status,
            ['Active', 'Completed'],
            true
        )) {

            return back()
                ->withInput()
                ->withErrors([
                    'placement_id' => 'A logbook can only be created for an active or completed placement.',
                ]);

        }

        $logbook = DailyLogbook::create(
            $request->validated()
        );

        return redirect()
            ->route(
                'daily-logbooks.show',
                $logbook
            )
            ->with(
                'success',
                'Daily logbook created successfully.'
            );
    }

    public function show(
        DailyLogbook $dailyLogbook
    ): View {
        $user = auth()->user();
        $isIndustryMentor = $user?->hasAnyRole([
            'Industry Supervisor',
            'Industry Mentor',
        ]);

        $industrySupervisorUser = $isIndustryMentor
            ? $user?->industrySupervisor
            : null;

        if ($isIndustryMentor && ! $industrySupervisorUser) {
            abort(403, 'Industry mentor profile not found.');
        }

        if ($industrySupervisorUser) {
            $dailyLogbook->loadMissing('placement');

            abort_unless(
                $dailyLogbook->placement
                && (int) $dailyLogbook->placement->industry_supervisor_id === (int) $industrySupervisorUser->id,
                403,
                'You can only view daily logbooks of students under your supervision.'
            );
        }

        $dailyLogbook->load([
            'placement.student',
            'placement.company',
            'placement.companyContact',
            'placement.academicSession',
        ]);

        return view(
            'daily-logbooks.show',
            compact('dailyLogbook')
        );
    }

    public function edit(
        DailyLogbook $dailyLogbook
    ): View {

        if ($dailyLogbook->status === 'Approved') {
            abort(403, 'Approved logbooks cannot be edited.');
        }

        $dailyLogbook->load([
            'placement.student.classRoom.programme',
            'placement.company',
            'placement.companyContact',
            'placement.industrySupervisor',
            'placement.academicSession',
        ]);

        $placement = $dailyLogbook->placement;

        return view(
            'daily-logbooks.edit',
            compact(
                'dailyLogbook',
                'placement'
            )
        );
    }

    public function update(
        DailyLogbookRequest $request,
        DailyLogbook $dailyLogbook
    ): RedirectResponse {

        if ($dailyLogbook->status === 'Approved') {
            abort(403, 'Approved logbooks cannot be edited.');
        }

        $placement = Placement::findOrFail(
            $request->integer('placement_id')
        );

        if (! in_array(
            $placement->status,
            ['Active', 'Completed'],
            true
        )) {

            return back()
                ->withInput()
                ->withErrors([
                    'placement_id' => 'A logbook can only belong to an active or completed placement.',
                ]);

        }

        $dailyLogbook->update(
            $request->validated()
        );

        return redirect()
            ->route(
                'daily-logbooks.show',
                $dailyLogbook
            )
            ->with(
                'success',
                'Daily logbook updated successfully.'
            );
    }

    public function destroy(
        DailyLogbook $dailyLogbook
    ): RedirectResponse {

        if ($dailyLogbook->status === 'Approved') {
            return back()->withErrors([
                'status' => 'Approved logbooks cannot be deleted.',
            ]);
        }

        $dailyLogbook->delete();

        return redirect()
            ->route('daily-logbooks.index')
            ->with(
                'success',
                'Daily logbook deleted successfully.'
            );
    }

    public function submit(DailyLogbook $dailyLogbook): RedirectResponse
    {

        if ($dailyLogbook->status !== 'Draft') {
            return back()->withErrors([
                'status' => 'Only draft logbooks can be submitted.',
            ]);
        }

        $dailyLogbook->update([
            'status' => 'Submitted',
        ]);

        return back()->with(
            'success',
            'Daily logbook submitted successfully.'
        );
    }

    public function approve(DailyLogbook $dailyLogbook): RedirectResponse
    {

        if ($dailyLogbook->status !== 'Submitted') {
            return back()->withErrors([
                'status' => 'Only submitted logbooks can be approved.',
            ]);
        }

        $dailyLogbook->update([
            'status' => 'Approved',
        ]);

        return back()->with(
            'success',
            'Daily logbook approved successfully.'
        );
    }

    public function reject(DailyLogbook $dailyLogbook): RedirectResponse
    {

        if ($dailyLogbook->status !== 'Submitted') {
            return back()->withErrors([
                'status' => 'Only submitted logbooks can be rejected.',
            ]);
        }

        $dailyLogbook->update([
            'status' => 'Rejected',
        ]);

        return back()->with(
            'success',
            'Daily logbook rejected successfully.'
        );
    }

    public function submitWeek(
        Request $request
    ): RedirectResponse {

        $student = $request->user()->student;

        abort_unless($student, 403);

        // Get active placement for this student
        $placement = $student
            ->placements()
            ->where('status', 'Active')
            ->latest('start_date')
            ->firstOrFail();

        // Determine the week from the requested date
        $date = Carbon::parse(
            $request->input('date', now())
        );

        $weekStart = $date->copy()->startOfWeek();
        $weekEnd = $date->copy()->endOfWeek();

        // Get daily logbooks for this week
        $dailyLogbooks = $placement
            ->dailyLogbooks()
            ->whereBetween('log_date', [
                $weekStart->toDateString(),
                $weekEnd->toDateString(),
            ])
            ->orderBy('log_date')
            ->get();

        // Must have at least one daily logbook
        if ($dailyLogbooks->isEmpty()) {
            return back()->with(
                'error',
                'There are no daily logbooks to submit for this week.'
            );
        }

        // Check if this week has already been submitted
        $existingSubmission = WeeklyLogbookSubmission::query()
            ->where('placement_id', $placement->id)
            ->whereDate('week_start_date', $weekStart)
            ->first();

        if ($existingSubmission) {
            return back()->with(
                'error',
                'This week has already been submitted.'
            );
        }

        $submission = WeeklyLogbookSubmission::create([
            'placement_id' => $placement->id,
            'week_start_date' => $weekStart->toDateString(),
            'week_end_date' => $weekEnd->toDateString(),
            'status' => 'Submitted',
            'submitted_at' => now(),
        ]);

        // Link daily logbooks to the weekly submission
        $dailyLogbooks->each(function ($logbook) use ($submission) {
            $logbook->update([
                'weekly_logbook_submission_id' => $submission->id,
            ]);
        });

        return back()->with(
            'success',
            'Weekly logbook submitted successfully.'
        );
    }
}
