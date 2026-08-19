<?php

namespace App\Http\Controllers;

use App\Models\AssessmentTemplate;
use App\Models\AssessmentVersion;
use Illuminate\Http\Request;

class AssessmentVersionController extends Controller
{
    public function index(AssessmentTemplate $assessmentTemplate)
    {
        $versions = $assessmentTemplate->versions()
            ->orderByDesc('version')
            ->paginate(10);

        return view(
            'assessment-versions.index',
            compact('assessmentTemplate', 'versions')
        );
    }

    public function create(AssessmentTemplate $assessmentTemplate)
    {
        $nextVersion = ($assessmentTemplate->versions()->max('version') ?? 0) + 1;

        return view(
            'assessment-versions.create',
            compact('assessmentTemplate', 'nextVersion')
        );
    }

    public function store(
        Request $request,
        AssessmentTemplate $assessmentTemplate
    ) {
        $validated = $request->validate([
            'version' => [
                'required',
                'integer',
                'min:1',
                'unique:assessment_versions,version,NULL,id,assessment_template_id,' . $assessmentTemplate->id,
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'instructions' => [
                'nullable',
                'string',
            ],
            'max_score' => [
                'required',
                'numeric',
                'min:0',
            ],
            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean('status');
        $validated['published_at'] = null;

        $assessmentTemplate->versions()->create($validated);

        return redirect()
            ->route(
                'assessment-versions.index',
                $assessmentTemplate
            )
            ->with('success', 'Assessment version berjaya ditambah.');
    }

    public function show(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion
    ) {
        $this->ensureBelongsToTemplate(
            $assessmentTemplate,
            $assessmentVersion
        );

        $assessmentVersion->load([
            'sections.criteria.ratingLevels',
        ]);

        return view(
            'assessment-versions.show',
            compact(
                'assessmentTemplate',
                'assessmentVersion'
            )
        );
    }

    public function edit(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion
    ) {
        $this->ensureBelongsToTemplate(
            $assessmentTemplate,
            $assessmentVersion
        );

        return view(
            'assessment-versions.edit',
            compact(
                'assessmentTemplate',
                'assessmentVersion'
            )
        );
    }

    public function update(
        Request $request,
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion
    ) {
        $this->ensureBelongsToTemplate(
            $assessmentTemplate,
            $assessmentVersion
        );

        if ($assessmentVersion->published_at) {
            return back()
                ->with('error', 'Published version tidak boleh diedit. Sila create version baru.');
        }

        $validated = $request->validate([
            'version' => [
                'required',
                'integer',
                'min:1',
                'unique:assessment_versions,version,' .
                    $assessmentVersion->id .
                    ',id,assessment_template_id,' .
                    $assessmentTemplate->id,
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'instructions' => [
                'nullable',
                'string',
            ],
            'max_score' => [
                'required',
                'numeric',
                'min:0',
            ],
            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean('status');

        $assessmentVersion->update($validated);

        return redirect()
            ->route(
                'assessment-versions.show',
                [
                    $assessmentTemplate,
                    $assessmentVersion,
                ]
            )
            ->with(
                'success',
                'Assessment version berjaya dikemaskini.'
            );
    }

    public function publish(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion
    ) {
        $this->ensureBelongsToTemplate(
            $assessmentTemplate,
            $assessmentVersion
        );

        /*
         * Hanya satu version boleh published
         * untuk satu assessment template.
         */
        $assessmentTemplate->versions()
            ->where('id', '!=', $assessmentVersion->id)
            ->update([
                'status' => false,
                'published_at' => null,
            ]);

        $assessmentVersion->update([
            'status' => true,
            'published_at' => now(),
        ]);

        return back()
            ->with(
                'success',
                'Assessment version berjaya dipublish.'
            );
    }

    public function unpublish(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion
    ) {
        $this->ensureBelongsToTemplate(
            $assessmentTemplate,
            $assessmentVersion
        );

        $assessmentVersion->update([
            'status' => false,
            'published_at' => null,
        ]);

        return back()
            ->with(
                'success',
                'Assessment version telah di-unpublish.'
            );
    }

    private function ensureBelongsToTemplate(
        AssessmentTemplate $assessmentTemplate,
        AssessmentVersion $assessmentVersion
    ): void {
        abort_unless(
            $assessmentVersion->assessment_template_id ===
                $assessmentTemplate->id,
            404
        );
    }
}
