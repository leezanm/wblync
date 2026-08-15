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
}
