<?php

namespace App\Http\Controllers;

use App\Models\WeeklyLogbookSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndustrySupervisorLogbookController extends Controller
{
    /**
     * Display weekly logbook submissions
     * belonging to the logged-in Industry Supervisor.
     */
    public function index(Request $request): View
    {
        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $submissions = WeeklyLogbookSubmission::query()
            ->whereHas('placement', function ($query) use ($industrySupervisor) {
                $query->where(
                    'industry_supervisor_id',
                    $industrySupervisor->id
                );
            })
            ->where('status', 'Submitted')
            ->with([
                'placement.student',
                'placement.company',
            ])
            ->latest('submitted_at')
            ->paginate(10)
            ->withQueryString();

        return view(
            'industry-supervisors.logbook-approvals.index',
            compact('submissions')
        );
    }

    /**
     * Display a weekly logbook submission.
     */
    public function show(
        Request $request,
        WeeklyLogbookSubmission $weeklyLogbookSubmission
    ): View {
        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $this->ensureOwnSubmission(
            $weeklyLogbookSubmission,
            $industrySupervisor->id
        );

        $weeklyLogbookSubmission->load([
            'placement.student',
            'placement.company',
            'dailyLogbooks' => function ($query) {
                $query->orderBy('log_date');
            },
        ]);

        // Backward compatibility: for older submissions created before
        // weekly_logbook_submission_id linking was fixed, fallback by week range.
        if ($weeklyLogbookSubmission->dailyLogbooks->isEmpty()) {
            $fallbackLogbooks = $weeklyLogbookSubmission
                ->placement
                ->dailyLogbooks()
                ->whereBetween('log_date', [
                    $weeklyLogbookSubmission->week_start_date->toDateString(),
                    $weeklyLogbookSubmission->week_end_date->toDateString(),
                ])
                ->orderBy('log_date')
                ->get();

            if ($fallbackLogbooks->isNotEmpty()) {
                $weeklyLogbookSubmission->setRelation(
                    'dailyLogbooks',
                    $fallbackLogbooks
                );
            }
        }

        return view(
            'industry-supervisors.logbook-approvals.show',
            compact('weeklyLogbookSubmission')
        );
    }

    /**
     * Approve weekly logbook.
     */
    public function approve(
        Request $request,
        WeeklyLogbookSubmission $weeklyLogbookSubmission
    ): RedirectResponse {
        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $this->ensureOwnSubmission(
            $weeklyLogbookSubmission,
            $industrySupervisor->id
        );

        abort_if(
            $weeklyLogbookSubmission->status !== 'Submitted',
            422,
            'This weekly logbook is not available for approval.'
        );

        $weeklyLogbookSubmission->update([
            'status' => 'Approved',
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
            'remarks' => $request->input('remarks'),
        ]);

        return redirect()
            ->route('industry-supervisor.logbook-approvals.index')
            ->with(
                'success',
                'Weekly logbook approved successfully.'
            );
    }

    /**
     * Reject weekly logbook.
     */
    public function reject(
        Request $request,
        WeeklyLogbookSubmission $weeklyLogbookSubmission
    ): RedirectResponse {
        $data = $request->validate([
            'remarks' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $this->ensureOwnSubmission(
            $weeklyLogbookSubmission,
            $industrySupervisor->id
        );

        abort_if(
            $weeklyLogbookSubmission->status !== 'Submitted',
            422,
            'This weekly logbook is not available for rejection.'
        );

        $weeklyLogbookSubmission->update([
            'status' => 'Rejected',
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
            'remarks' => $data['remarks'],
        ]);

        return redirect()
            ->route('industry-supervisor.logbook-approvals.index')
            ->with(
                'success',
                'Weekly logbook rejected successfully.'
            );
    }

    /**
     * Ensure the submission belongs to the logged-in supervisor.
     */
    private function ensureOwnSubmission(
        WeeklyLogbookSubmission $submission,
        int $industrySupervisorId
    ): void {
        $belongsToSupervisor = $submission
            ->placement()
            ->where(
                'industry_supervisor_id',
                $industrySupervisorId
            )
            ->exists();

        abort_unless(
            $belongsToSupervisor,
            403,
            'You are not authorised to access this weekly logbook.'
        );
    }

    public function submitWeek(
        Request $request
    ): RedirectResponse {
        $student = $request->user()->student;

        abort_unless($student, 403);

        $placement = $student
            ->placements()
            ->where('status', 'Active')
            ->latest('start_date')
            ->firstOrFail();

        $date = $request->filled('date')
            ? $request->date('date')
            : now();

        $weekStart = $date->copy()->startOfWeek();
        $weekEnd = $date->copy()->endOfWeek();

        $dailyLogbooks = $placement
            ->dailyLogbooks()
            ->whereBetween('log_date', [
                $weekStart->toDateString(),
                $weekEnd->toDateString(),
            ])
            ->orderBy('log_date')
            ->get();

        if ($dailyLogbooks->isEmpty()) {
            return back()->with(
                'error',
                'There are no daily logbooks to submit for this week.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Find Existing Weekly Submission
        |--------------------------------------------------------------------------
        */

        $submission = WeeklyLogbookSubmission::query()
            ->where('placement_id', $placement->id)
            ->whereDate(
                'week_start_date',
                $weekStart->toDateString()
            )
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Already Submitted / Approved
        |--------------------------------------------------------------------------
        */

        if (
            $submission
            && in_array($submission->status, [
                'Submitted',
                'Approved',
            ])
        ) {
            return back()->with(
                'error',
                'This week has already been submitted.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create New Submission
        |--------------------------------------------------------------------------
        */

        if (! $submission) {

            $submission = WeeklyLogbookSubmission::create([
                'placement_id' => $placement->id,
                'week_start_date' => $weekStart->toDateString(),
                'week_end_date' => $weekEnd->toDateString(),
                'status' => 'Submitted',
                'submitted_at' => now(),
                'reviewed_at' => null,
                'reviewed_by' => null,
                'remarks' => null,
            ]);

        } else {

            /*
            |--------------------------------------------------------------------------
            | Resubmit Rejected Submission
            |--------------------------------------------------------------------------
            */

            $submission->update([
                'status' => 'Submitted',
                'submitted_at' => now(),
                'reviewed_at' => null,
                'reviewed_by' => null,
                'remarks' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Link Daily Logbooks
        |--------------------------------------------------------------------------
        */

        $dailyLogbooks->each(function ($logbook) use ($submission) {

            $logbook->update([
                'weekly_logbook_submission_id' => $submission->id,
            ]);
        });

        return redirect()
            ->route('daily-logbooks.index')
            ->with(
                'success',
                'Weekly logbook submitted successfully.'
            );
    }

    public function history(Request $request): View
    {
        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $submissions = WeeklyLogbookSubmission::query()
            ->whereHas('placement', function ($query) use ($industrySupervisor) {
                $query->where(
                    'industry_supervisor_id',
                    $industrySupervisor->id
                );
            })
            ->whereIn('status', [
                'Approved',
                'Rejected',
            ])
            ->with([
                'placement.student',
                'placement.company',
                'reviewer',
            ])
            ->latest('reviewed_at')
            ->paginate(10)
            ->withQueryString();

        return view(
            'industry-supervisors.logbook-approvals.history',
            compact('submissions')
        );
    }
}
