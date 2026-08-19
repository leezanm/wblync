<?php

namespace App\Http\Controllers;

use App\Models\AssessmentCriterion;
use App\Models\AssessmentSection;
use Illuminate\Http\Request;

class AssessmentCriterionController extends Controller
{
    public function index($assessmentSection)
    {
        $assessmentSection = AssessmentSection::with(
            'assessmentVersion.assessmentTemplate'
        )->findOrFail($assessmentSection);

        $criteria = $assessmentSection->criteria()
            ->withCount('ratingLevels')
            ->orderBy('sort_order')
            ->paginate(10);

        return view(
            'assessment-criteria.index',
            compact(
                'assessmentSection',
                'criteria'
            )
        );
    }

    public function create($assessmentSection)
    {
        $assessmentSection = AssessmentSection::with(
            'assessmentVersion.assessmentTemplate'
        )->findOrFail($assessmentSection);

        $nextSortOrder =
            ($assessmentSection->criteria()->max('sort_order') ?? 0) + 1;

        return view(
            'assessment-criteria.create',
            compact(
                'assessmentSection',
                'nextSortOrder'
            )
        );
    }

    public function store(
        Request $request,
        $assessmentSection
    ) {
        $assessmentSection = AssessmentSection::findOrFail(
            $assessmentSection
        );

        $version = $assessmentSection
            ->assessmentVersion;

        if ($version->published_at) {
            return back()->with(
                'error',
                'Published version tidak boleh diubah.'
            );
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'max_score' => [
                'required',
                'numeric',
                'min:0',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],

            'is_required' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_required'] =
            $request->boolean('is_required');

        $assessmentSection->criteria()->create(
            $validated
        );

        return redirect()
            ->route(
                'assessment-criteria.index',
                [
                    'assessmentTemplate' => $version->assessment_template_id,

                    'assessmentVersion' => $version->id,

                    'assessmentSection' => $assessmentSection->id,
                ]
            )
            ->with(
                'success',
                'Assessment criterion berjaya ditambah.'
            );
    }

    public function show(
        $assessmentSection,
        $assessmentCriterion
    ) {
        $assessmentSection = AssessmentSection::with(
            'assessmentVersion.assessmentTemplate'
        )->findOrFail($assessmentSection);

        $criterion = AssessmentCriterion::with(
            'ratingLevels'
        )->where(
            'assessment_section_id',
            $assessmentSection->id
        )->findOrFail($assessmentCriterion);

        return view(
            'assessment-criteria.show',
            compact(
                'assessmentSection',
                'criterion'
            )
        );
    }

    public function edit(
        $assessmentSection,
        $assessmentCriterion
    ) {
        $assessmentSection = AssessmentSection::with(
            'assessmentVersion.assessmentTemplate'
        )->findOrFail($assessmentSection);

        $criterion = AssessmentCriterion::where(
            'assessment_section_id',
            $assessmentSection->id
        )->findOrFail($assessmentCriterion);

        return view(
            'assessment-criteria.edit',
            compact(
                'assessmentSection',
                'criterion'
            )
        );
    }

    public function update(
        Request $request,
        $assessmentSection,
        $assessmentCriterion
    ) {
        $assessmentSection = AssessmentSection::findOrFail(
            $assessmentSection
        );

        $criterion = AssessmentCriterion::where(
            'assessment_section_id',
            $assessmentSection->id
        )->findOrFail($assessmentCriterion);

        $version = $assessmentSection->assessmentVersion;

        if ($version->published_at) {
            return back()->with(
                'error',
                'Published version tidak boleh diubah.'
            );
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'max_score' => [
                'required',
                'numeric',
                'min:0',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],

            'is_required' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_required'] =
            $request->boolean('is_required');

        $criterion->update($validated);

        return redirect()
            ->route(
                'assessment-criteria.show',
                [
                    'assessmentTemplate' => $version->assessment_template_id,

                    'assessmentVersion' => $version->id,

                    'assessmentSection' => $assessmentSection->id,

                    'assessmentCriterion' => $criterion->id,
                ]
            )
            ->with(
                'success',
                'Assessment criterion berjaya dikemaskini.'
            );
    }

    public function destroy(
        $assessmentSection,
        $assessmentCriterion
    ) {
        $assessmentSection = AssessmentSection::findOrFail(
            $assessmentSection
        );

        $criterion = AssessmentCriterion::where(
            'assessment_section_id',
            $assessmentSection->id
        )->findOrFail($assessmentCriterion);

        $version = $assessmentSection->assessmentVersion;

        if ($version->published_at) {
            return back()->with(
                'error',
                'Published version tidak boleh diubah.'
            );
        }

        $criterion->delete();

        return redirect()
            ->route(
                'assessment-criteria.index',
                [
                    'assessmentTemplate' => $version->assessment_template_id,

                    'assessmentVersion' => $version->id,

                    'assessmentSection' => $assessmentSection->id,
                ]
            )
            ->with(
                'success',
                'Assessment criterion berjaya dipadam.'
            );
    }
}
