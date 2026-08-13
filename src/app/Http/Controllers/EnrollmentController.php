<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentRequest;
use App\Models\AcademicSession;
use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Enrollment::query()
            ->with([
                'student.classRoom.academicSession',
                'student.classRoom.semester',
                'student.classRoom.programme',
                'classCourse.course',
                'classCourse.classRoom',
            ]);

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query
                    ->whereHas('student', function ($query) use ($search) {
                        $query
                            ->where('student_no', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('classCourse.course', function ($query) use ($search) {
                        $query
                            ->where('code', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('student_id')) {
            $query->where(
                'student_id',
                $request->integer('student_id')
            );
        }

        if ($request->filled('academic_session_id')) {
            $query->whereHas('classCourse.classRoom', function ($query) use ($request) {
                $query->where(
                    'academic_session_id',
                    $request->integer('academic_session_id')
                );
            });
        }

        if ($request->filled('semester_id')) {
            $query->whereHas('classCourse.classRoom', function ($query) use ($request) {
                $query->where(
                    'semester_id',
                    $request->integer('semester_id')
                );
            });
        }

        if ($request->filled('course_id')) {
            $query->whereHas('classCourse', function ($query) use ($request) {
                $query->where(
                    'course_id',
                    $request->integer('course_id')
                );
            });
        }

        if ($request->filled('class_course_id')) {
            $query->where(
                'class_course_id',
                $request->integer('class_course_id')
            );
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $enrollments = $query
            ->latest()
            ->paginate(10);

        $students = Student::query()
            ->with('classRoom')
            ->where('status', true)
            ->orderBy('student_no')
            ->get();

        $classCourses = ClassCourse::query()
            ->with([
                'course',
                'classRoom',
            ])
            ->where('status', true)
            ->orderBy('id')
            ->get();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        $semesters = Semester::query()
            ->get();

        $courses = Course::query()
            ->where('status', true)
            ->orderBy('code')
            ->get();

        return view('enrollments.index', compact(
            'enrollments',
            'students',
            'classCourses',
            'academicSessions',
            'semesters',
            'courses',
        ));
    }

    public function create(): View
    {
        $students = Student::query()
            ->with([
                'classRoom',
                'classRoom.programme',
                'classRoom.semester',
                'classRoom.academicSession',
            ])
            ->where('status', true)
            ->orderBy('student_no')
            ->get();

        $classCourses = ClassCourse::query()
            ->with([
                'course',
                'classRoom',
                'classRoom.programme',
                'classRoom.semester',
                'classRoom.academicSession',
            ])
            ->where('status', true)
            ->orderBy('id')
            ->get();

        return view('enrollments.create', compact(
            'students',
            'classCourses',
        ));
    }

    public function store(
        EnrollmentRequest $request
    ): RedirectResponse {
        Enrollment::create(
            $request->validated()
        );

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Student enrolled in course successfully.'
            );
    }

    public function show(
        Enrollment $enrollment
    ): View {
        $enrollment->load([
            'student.classRoom.academicSession',
            'student.classRoom.semester',
            'student.classRoom.programme',
            'classCourse.course',
            'classCourse.classRoom',
        ]);

        return view(
            'enrollments.show',
            compact('enrollment')
        );
    }

    public function edit(
        Enrollment $enrollment
    ): View {
        $students = Student::query()
            ->with([
                'classRoom',
                'classRoom.programme',
                'classRoom.semester',
                'classRoom.academicSession',
            ])
            ->where('status', true)
            ->orderBy('student_no')
            ->get();

        $classCourses = ClassCourse::query()
            ->with([
                'course',
                'classRoom',
                'classRoom.programme',
                'classRoom.semester',
                'classRoom.academicSession',
            ])
            ->where('status', true)
            ->orderBy('id')
            ->get();

        return view(
            'enrollments.edit',
            compact(
                'enrollment',
                'students',
                'classCourses',
            )
        );
    }

    public function update(
        EnrollmentRequest $request,
        Enrollment $enrollment
    ): RedirectResponse {
        $enrollment->update(
            $request->validated()
        );

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Student enrollment updated successfully.'
            );
    }

    public function destroy(
        Enrollment $enrollment
    ): RedirectResponse {
        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Student enrollment removed successfully.'
            );
    }
}
