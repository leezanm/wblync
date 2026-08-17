<?php

namespace App\Http\Controllers;

use App\Models\DailyLogbook;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndustrySupervisorLogbookController extends Controller
{
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

        $logbooks = DailyLogbook::query()
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
            ->latest('log_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'industry-supervisors.logbook-approvals.index',
            compact('logbooks')
        );
    }

    public function show(
        Request $request,
        DailyLogbook $dailyLogbook
    ): View {
        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $this->ensureOwnLogbook(
            $dailyLogbook,
            $industrySupervisor->id
        );

        abort_unless(
            in_array($dailyLogbook->status, [
                'Submitted',
                'Approved',
                'Rejected',
            ], true),
            404
        );

        $dailyLogbook->load([
            'placement.student',
            'placement.company',
            'placement.academicSession',
        ]);

        return view(
            'industry-supervisors.logbook-approvals.show',
            compact('dailyLogbook')
        );
    }

    public function approve(
        Request $request,
        DailyLogbook $dailyLogbook
    ): RedirectResponse {
        $industrySupervisor = $request
            ->user()
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403,
            'Industry Supervisor profile not found.'
        );

        $this->ensureOwnLogbook(
            $dailyLogbook,
            $industrySupervisor->id
        );

        abort_if(
            $dailyLogbook->status !== 'Submitted',
            422,
            'This daily logbook is not available for approval.'
        );

        $dailyLogbook->update([
            'status' => 'Approved',
            'remarks' => $request->input('remarks'),
        ]);

        return redirect()
            ->route('industry-supervisor.logbook-approvals.index')
            ->with(
                'success',
                'Daily logbook approved successfully.'
            );
    }

    public function reject(
        Request $request,
        DailyLogbook $dailyLogbook
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

        $this->ensureOwnLogbook(
            $dailyLogbook,
            $industrySupervisor->id
        );

        abort_if(
            $dailyLogbook->status !== 'Submitted',
            422,
            'This daily logbook is not available for rejection.'
        );

        $dailyLogbook->update([
            'status' => 'Rejected',
            'remarks' => $data['remarks'],
        ]);

        return redirect()
            ->route('industry-supervisor.logbook-approvals.index')
            ->with(
                'success',
                'Daily logbook rejected successfully.'
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

        $logbooks = DailyLogbook::query()
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
            ])
            ->latest('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view(
            'industry-supervisors.logbook-approvals.history',
            compact('logbooks')
        );
    }

    private function ensureOwnLogbook(
        DailyLogbook $dailyLogbook,
        int $industrySupervisorId
    ): void {
        $belongsToSupervisor = $dailyLogbook
            ->placement()
            ->where(
                'industry_supervisor_id',
                $industrySupervisorId
            )
            ->exists();

        abort_unless(
            $belongsToSupervisor,
            403,
            'You are not authorised to access this daily logbook.'
        );
    }
}
