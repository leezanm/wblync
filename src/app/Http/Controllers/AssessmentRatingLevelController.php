<?php

namespace App\Http\Controllers;

use App\Models\AssessmentCriterion;
use App\Models\AssessmentRatingLevel;
use Illuminate\Http\Request;

class AssessmentRatingLevelController extends Controller
{
    public function index($assessmentCriterion)
    {
        $criterion = AssessmentCriterion::with([
            'assessmentSection.assessmentVersion.assessmentTemplate',
            'ratingLevels',
        ])->findOrFail($assessmentCriterion);

        return view(
            'assessment-rating-levels.index',
            compact('criterion')
        );
    }

    public function create($assessmentCriterion)
    {
        $criterion = AssessmentCriterion::with(
            'assessmentSection.assessmentVersion'
        )->findOrFail($assessmentCriterion);

        $nextSortOrder =
            ($criterion->ratingLevels()->max('sort_order') ?? 0) + 1;

        return view(
            'assessment-rating-levels.create',
            compact(
                'criterion',
                'nextSortOrder'
            )
        );
    }

    public function store(
        Request $request,
        $assessmentCriterion
    ) {
        $criterion = AssessmentCriterion::with(
            'assessmentSection.assessmentVersion'
        )->findOrFail($assessmentCriterion);

        $version = $criterion
            ->assessmentSection
            ->assessmentVersion;

        if ($version->published_at) {
            return back()->with(
                'error',
                'Published version tidak boleh diubah.'
            );
        }

        $validated = $request->validate([
            'score' => [
                'required',
                'numeric',
                'min:0',
                'max:' . $criterion->max_score,
            ],

            'label' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $criterion->ratingLevels()->create(
            $validated
        );

        return redirect()
            ->route(
                'assessment-rating-levels.index',
                [
                    'assessmentTemplate' =>
                        $version->assessment_template_id,

                    'assessmentVersion' =>
                        $version->id,

                    'assessmentSection' =>
                        $criterion->assessment_section_id,

                    'assessmentCriterion' =>
                        $criterion->id,
                ]
            )
            ->with(
                'success',
                'Rating level berjaya ditambah.'
            );
    }

    public function edit(
        $assessmentCriterion,
        $assessmentRatingLevel
    ) {
        $criterion = AssessmentCriterion::with(
            'assessmentSection.assessmentVersion'
        )->findOrFail($assessmentCriterion);

        $ratingLevel = AssessmentRatingLevel::where(
            'assessment_criterion_id',
            $criterion->id
        )->findOrFail($assessmentRatingLevel);

        return view(
            'assessment-rating-levels.edit',
            compact(
                'criterion',
                'ratingLevel'
            )
        );
    }

    public function update(
        Request $request,
        $assessmentCriterion,
        $assessmentRatingLevel
    ) {
        $criterion = AssessmentCriterion::with(
            'assessmentSection.assessmentVersion'
        )->findOrFail($assessmentCriterion);

        $ratingLevel = AssessmentRatingLevel::where(
            'assessment_criterion_id',
            $criterion->id
        )->findOrFail($assessmentRatingLevel);

        $version = $criterion
            ->assessmentSection
            ->assessmentVersion;

        if ($version->published_at) {
            return back()->with(
                'error',
                'Published version tidak boleh diubah.'
            );
        }

        $validated = $request->validate([
            'score' => [
                'required',
                'numeric',
                'min:0',
                'max:' . $criterion->max_score,
            ],

            'label' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $ratingLevel->update($validated);

        return redirect()
            ->route(
                'assessment-criteria.show',
                [
                    'assessmentTemplate' =>
                        $version->assessment_template_id,

                    'assessmentVersion' =>
                        $version->id,

                    'assessmentSection' =>
                        $criterion->assessment_section_id,

                    'assessmentCriterion' =>
                        $criterion->id,
                ]
            )
            ->with(
                'success',
                'Rating level berjaya dikemaskini.'
            );
    }

    public function destroy(
        $assessmentCriterion,
        $assessmentRatingLevel
    ) {
        $criterion = AssessmentCriterion::with(
            'assessmentSection.assessmentVersion'
        )->findOrFail($assessmentCriterion);

        $ratingLevel = AssessmentRatingLevel::where(
            'assessment_criterion_id',
            $criterion->id
        )->findOrFail($assessmentRatingLevel);

        $version = $criterion
            ->assessmentSection
            ->assessmentVersion;

        if ($version->published_at) {
            return back()->with(
                'error',
                'Published version tidak boleh diubah.'
            );
        }

        $ratingLevel->delete();

        return redirect()
            ->route(
                'assessment-criteria.show',
                [
                    'assessmentTemplate' =>
                        $version->assessment_template_id,

                    'assessmentVersion' =>
                        $version->id,

                    'assessmentSection' =>
                        $criterion->assessment_section_id,

                    'assessmentCriterion' =>
                        $criterion->id,
                ]
            )
            ->with(
                'success',
                'Rating level berjaya dipadam.'
            );
    }
}
