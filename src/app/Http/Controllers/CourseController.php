<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Programme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Course::query()
            ->with('programme');

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhereHas('programme', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('programme_id')) {
            $query->where(
                'programme_id',
                $request->integer('programme_id')
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $courses = $query
            ->latest()
            ->paginate(10);

        $programmes = Programme::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('courses.index', compact(
            'courses',
            'programmes'
        ));
    }

    public function create(): View
    {
        $programmes = Programme::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('courses.create', compact('programmes'));
    }

    public function store(CourseRequest $request): RedirectResponse
    {
        Course::create($request->validated());

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course): View
    {
        $course->load('programme');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        $programmes = Programme::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('courses.edit', compact(
            'course',
            'programmes'
        ));
    }

    public function update(
        CourseRequest $request,
        Course $course
    ): RedirectResponse {
        $course->update($request->validated());

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
