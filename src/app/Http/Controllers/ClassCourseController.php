<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassCourseRequest;
use App\Models\ClassCourse;
use App\Models\ClassRoom;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassCourseController extends Controller
{
    public function index(Request $request): View
    {
        $query = ClassCourse::query()
            ->with([
                'classRoom.academicSession',
                'classRoom.semester',
                'classRoom.programme',
                'course.programme',
            ]);

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query
                    ->whereHas('classRoom', function ($query) use ($search) {
                        $query
                            ->where('code', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('course', function ($query) use ($search) {
                        $query
                            ->where('code', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('class_room_id')) {
            $query->where(
                'class_room_id',
                $request->integer('class_room_id')
            );
        }

        if ($request->filled('course_id')) {
            $query->where(
                'course_id',
                $request->integer('course_id')
            );
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $classCourses = $query
            ->latest()
            ->paginate(10);

        $classRooms = ClassRoom::query()
            ->with([
                'academicSession',
                'semester',
                'programme',
            ])
            ->orderBy('code')
            ->get();

        $courses = Course::query()
            ->with('programme')
            ->orderBy('code')
            ->get();

        return view('class-courses.index', compact(
            'classCourses',
            'classRooms',
            'courses',
        ));
    }

    public function create(): View
    {
        $classRooms = ClassRoom::query()
            ->where('status', true)
            ->with([
                'academicSession',
                'semester',
                'programme',
            ])
            ->orderBy('code')
            ->get();

        $courses = Course::query()
            ->where('status', true)
            ->with('programme')
            ->orderBy('code')
            ->get();

        return view('class-courses.create', compact(
            'classRooms',
            'courses',
        ));
    }

    public function store(
        ClassCourseRequest $request
    ): RedirectResponse {
        ClassCourse::create(
            $request->validated()
        );

        return redirect()
            ->route('class-courses.index')
            ->with(
                'success',
                'Course assigned to class successfully.'
            );
    }

    public function show(
        ClassCourse $classCourse
    ): View {
        $classCourse->load([
            'classRoom.academicSession',
            'classRoom.semester',
            'classRoom.programme',
            'course.programme',
        ]);

        return view(
            'class-courses.show',
            compact('classCourse')
        );
    }

    public function edit(
        ClassCourse $classCourse
    ): View {
        $classRooms = ClassRoom::query()
            ->where('status', true)
            ->with([
                'academicSession',
                'semester',
                'programme',
            ])
            ->orderBy('code')
            ->get();

        $courses = Course::query()
            ->where('status', true)
            ->with('programme')
            ->orderBy('code')
            ->get();

        return view(
            'class-courses.edit',
            compact(
                'classCourse',
                'classRooms',
                'courses',
            )
        );
    }

    public function update(
        ClassCourseRequest $request,
        ClassCourse $classCourse
    ): RedirectResponse {
        $classCourse->update(
            $request->validated()
        );

        return redirect()
            ->route('class-courses.index')
            ->with(
                'success',
                'Class course assignment updated successfully.'
            );
    }

    public function destroy(
        ClassCourse $classCourse
    ): RedirectResponse {
        $classCourse->delete();

        return redirect()
            ->route('class-courses.index')
            ->with(
                'success',
                'Course removed from class successfully.'
            );
    }
}
