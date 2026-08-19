<?php

namespace App\Http\Controllers;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssessmentTemplateController extends Controller
{
    public function index()
    {
        $assessmentTemplates = AssessmentTemplate::with([
            'course',
            'versions',
        ])
            ->latest()
            ->paginate(10);

        return view(
            'assessment-templates.index',
            compact('assessmentTemplates')
        );
    }

    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('code')
            ->get();

        return view(
            'assessment-templates.create',
            compact('courses')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'code' => ['required', 'string', 'max:100', 'unique:assessment_templates,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'assessor_type' => ['required', 'string', 'max:100'],
            'status' => ['boolean'],
        ]);

        $validated['uuid'] = (string) Str::uuid();
        $validated['status'] = $request->boolean('status');

        AssessmentTemplate::create($validated);

        return redirect()
            ->route('assessment-templates.index')
            ->with('success', 'Assessment template berjaya ditambah.');
    }

    public function show(AssessmentTemplate $assessmentTemplate)
    {
        $assessmentTemplate->load([
            'course',
            'versions.sections.criteria.ratingLevels',
        ]);

        return view(
            'assessment-templates.show',
            compact('assessmentTemplate')
        );
    }

    public function edit(AssessmentTemplate $assessmentTemplate)
    {
        $courses = Course::where('status', true)
            ->orderBy('code')
            ->get();

        return view(
            'assessment-templates.edit',
            compact('assessmentTemplate', 'courses')
        );
    }

    public function update(
        Request $request,
        AssessmentTemplate $assessmentTemplate
    ) {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'code' => [
                'required',
                'string',
                'max:100',
                'unique:assessment_templates,code,'.$assessmentTemplate->id,
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'assessor_type' => ['required', 'string', 'max:100'],
            'status' => ['boolean'],
        ]);

        $validated['status'] = $request->boolean('status');

        $assessmentTemplate->update($validated);

        return redirect()
            ->route('assessment-templates.show', $assessmentTemplate)
            ->with('success', 'Assessment template berjaya dikemaskini.');
    }

    public function destroy(AssessmentTemplate $assessmentTemplate)
    {
        $assessmentTemplate->delete();

        return redirect()
            ->route('assessment-templates.index')
            ->with('success', 'Assessment template berjaya dipadam.');
    }
}
