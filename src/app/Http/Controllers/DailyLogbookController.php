<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailyLogbookRequest;
use App\Models\DailyLogbook;
use App\Models\Placement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DailyLogbookController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = DailyLogbook::query()
            ->with([
                'placement.student',
                'placement.company',
            ]);

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

        if ($isIndustryMentor && ! $industrySupervisorUser) {
            abort(403, 'Industry mentor profile not found.');
        }

        if ($studentUser) {
            $query->whereHas('placement', function ($query) use ($studentUser) {
                $query->where('student_id', $studentUser->id);
            });
        } elseif ($industrySupervisorUser) {
            $query->whereHas('placement', function ($query) use ($industrySupervisorUser) {
                $query->where('industry_supervisor_id', $industrySupervisorUser->id);
            });
        } elseif ($request->filled('student_id')) {
            $query->whereHas('placement', function ($query) use ($request) {
                $query->where('student_id', $request->integer('student_id'));
            });
        }

        if ($request->filled('search')) {

            $search = $request->string('search')->trim();

            $query->whereHas('placement', function ($query) use ($search) {

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
            });
        }

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        if ($request->filled('date_from')) {
            $query->whereDate(
                'log_date',
                '>=',
                $request->date('date_from')->toDateString()
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'log_date',
                '<=',
                $request->date('date_to')->toDateString()
            );
        }

        $logbooks = $query
            ->latest('log_date')
            ->paginate(10);

        return view(
            'daily-logbooks.index',
            compact('logbooks')
        );
    }

    public function create(): View
    {
        $placements = Placement::query()
            ->with([
                'student',
                'company',
            ])
            ->whereIn('status', [
                'Active',
                'Completed',
            ])
            ->orderByDesc('start_date')
            ->get();

        return view(
            'daily-logbooks.create',
            compact('placements')
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

        $dailyLogbook->load('placement');

        $placements = Placement::query()
            ->with([
                'student',
                'company',
            ])
            ->whereIn('status', [
                'Active',
                'Completed',
            ])
            ->orderByDesc('start_date')
            ->get();

        return view(
            'daily-logbooks.edit',
            compact(
                'dailyLogbook',
                'placements'
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
}
