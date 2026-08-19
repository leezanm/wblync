<?php

namespace App\Http\Controllers;

use App\Models\AssessmentSection;
use App\Models\AssessmentTemplate;
use App\Models\AssessmentVersion;
use Illuminate\Http\Request;

class AssessmentSectionController extends Controller
{
    public function index(AssessmentTemplate $assessmentTemplate, AssessmentVersion $assessmentVersion)
    {
        $assessmentVersion->load('assessmentTemplate');

        $sections = $assessmentVersion->sections()
            ->withCount('criteria')
            ->orderBy('sort_order')
            ->paginate(10);

        return view(
            'assessment-sections.index',
            compact('assessmentVersion', 'sections')
        );
    }

    public function create(AssessmentTemplate $assessmentTemplate, AssessmentVersion $assessmentVersion)
    {
        $assessmentVersion->load('assessmentTemplate');

        $nextSortOrder =
            ($assessmentVersion->sections()->max('sort_order') ?? 0) + 1;

        return view(
            'assessment-sections.create',
            compact('assessmentVersion', 'nextSortOrder')
        );
    }

    public function store(Request $request, AssessmentTemplate $assessmentTemplate, AssessmentVersion $assessmentVersion)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $assessmentVersion->sections()->create($validated);

        return redirect()
            ->route('assessment-sections.index', [$assessmentTemplate, $assessmentVersion])
            ->with('success', 'Assessment section berjaya ditambah.');
    }

    public function show(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion,
        AssessmentSection $assessmentSection
    ) {
        $this->ensureBelongsToVersion($assessmentVersion, $assessmentSection);

        $assessmentVersion->load('assessmentTemplate');

        $assessmentSection->load(['criteria.ratingLevels']);

        return view(
            'assessment-sections.show',
            compact('assessmentVersion', 'assessmentSection')
        );
    }

    public function edit(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion,
        AssessmentSection $assessmentSection
    ) {
        $this->ensureBelongsToVersion($assessmentVersion, $assessmentSection);

        $assessmentVersion->load('assessmentTemplate');

        return view(
            'assessment-sections.edit',
            compact('assessmentVersion', 'assessmentSection')
        );
    }

    public function update(
        Request $request,
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion,
        AssessmentSection $assessmentSection
    ) {
        $this->ensureBelongsToVersion($assessmentVersion, $assessmentSection);

        if ($assessmentVersion->published_at) {
            return back()->with('error', 'Published version tidak boleh diubah.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $assessmentSection->update($validated);

        return redirect()
            ->route('assessment-sections.show', [$assessmentTemplate, $assessmentVersion, $assessmentSection])
            ->with('success', 'Assessment section berjaya dikemaskini.');
    }

    private function ensureBelongsToVersion(
        AssessmentVersion $assessmentVersion,
        AssessmentSection $assessmentSection
    ): void {
        abort_unless(
            $assessmentSection->assessment_version_id === $assessmentVersion->id,
            404
        );
    }
}
