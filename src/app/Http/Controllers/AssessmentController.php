<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssessmentRequest;
use App\Models\Assessment;
use App\Models\Placement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Assessment::query()
            ->with([
                'placement.student',
                'placement.company',
            ]);

        $studentUser = auth()->user()?->hasRole('Student')
            ? auth()->user()?->student
            : null;

        if ($studentUser) {
            $query->whereHas('placement', function ($query) use ($studentUser) {
                $query->where('student_id', $studentUser->id);
            });
        } elseif ($request->filled('student_id')) {
            $query->whereHas('placement', function ($query) use ($request) {
                $query->where('student_id', $request->integer('student_id'));
            });
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->whereHas('placement', function ($query) use ($search) {

                $query->whereHas('student', function ($query) use ($search) {
                    $query
                        ->where('student_no', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });

                $query->orWhereHas('company', function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $assessments = $query
            ->latest('assessment_date')
            ->paginate(10);

        return view(
            'assessments.index',
            compact('assessments')
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
            'assessments.create',
            compact('placements')
        );
    }

    public function store(
        AssessmentRequest $request
    ): RedirectResponse {
        $placement = Placement::findOrFail(
            $request->integer('placement_id')
        );

        if (! in_array($placement->status, [
            'Active',
            'Completed',
        ], true)) {
            return back()
                ->withInput()
                ->withErrors([
                    'placement_id' => 'Assessment can only be created for an active or completed placement.',
                ]);
        }

        $assessment = Assessment::create(
            $request->validated()
        );

        return redirect()
            ->route('assessments.show', $assessment)
            ->with(
                'success',
                'Assessment created successfully.'
            );
    }

    public function show(
        Assessment $assessment
    ): View {
        $assessment->load([
            'placement.student',
            'placement.company',
            'placement.companyContact',
            'placement.academicSession',
        ]);

        return view(
            'assessments.show',
            compact('assessment')
        );
    }

    public function edit(
        Assessment $assessment
    ): View {
        $assessment->load('placement');

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
            'assessments.edit',
            compact(
                'assessment',
                'placements'
            )
        );
    }

    public function update(
        AssessmentRequest $request,
        Assessment $assessment
    ): RedirectResponse {
        $placement = Placement::findOrFail(
            $request->integer('placement_id')
        );

        if (! in_array($placement->status, [
            'Active',
            'Completed',
        ], true)) {
            return back()
                ->withInput()
                ->withErrors([
                    'placement_id' => 'Assessment can only belong to an active or completed placement.',
                ]);
        }

        $assessment->update(
            $request->validated()
        );

        return redirect()
            ->route('assessments.show', $assessment)
            ->with(
                'success',
                'Assessment updated successfully.'
            );
    }

    public function destroy(
        Assessment $assessment
    ): RedirectResponse {
        $assessment->delete();

        return redirect()
            ->route('assessments.index')
            ->with(
                'success',
                'Assessment deleted successfully.'
            );
    }
}
