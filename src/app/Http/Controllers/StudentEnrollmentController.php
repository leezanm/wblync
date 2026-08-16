<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\ClassRoom;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentEnrollmentController extends Controller
{
    public function create(): View
    {
        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        $semesters = Semester::query()
            ->orderBy('id')
            ->get();

        $classRooms = ClassRoom::query()
            ->with([
                'academicSession',
                'semester',
                'programme',
            ])
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $students = Student::query()
            ->orderBy('name')
            ->get();

        return view(
            'student-enrollments.create',
            compact(
                'academicSessions',
                'semesters',
                'classRooms',
                'students'
            )
        );
    }

    public function store(Request $request)
    {
            $validated = $request->validate([
                'class_room_id' => [
                    'required',
                    'exists:class_rooms,id',
                ],

                'class_course_ids' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'class_course_ids.*' => [
                    'integer',
                    'exists:class_courses,id',
                ],

                'student_ids' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'student_ids.*' => [
                    'integer',
                    'exists:students,id',
                ],
            ]);

            $classRoom = ClassRoom::query()
                ->with([
                    'classCourses',
                    'academicSession',
                    'semester',
                    'programme',
                ])
                ->findOrFail($validated['class_room_id']);

            /*
            |--------------------------------------------------------------------------
            | Pastikan course yang dipilih memang berada dalam class tersebut
            |--------------------------------------------------------------------------
            */

            $validCourseIds = $classRoom->classCourses
                ->where('status', 1)
                ->pluck('id');

            foreach ($validated['class_course_ids'] as $courseId) {

                abort_unless(
                    $validCourseIds->contains((int) $courseId),
                    422,
                    'The selected course does not belong to this class.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Enroll students
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use (
                $validated,
                $classRoom
            ) {

                foreach ($validated['student_ids'] as $studentId) {

                    $student = Student::findOrFail($studentId);


                    /*
                    |--------------------------------------------------------------------------
                    | 1. Check existing StudentEnrollment
                    |--------------------------------------------------------------------------
                    */

                    $studentEnrollment = StudentEnrollment::query()
                        ->where('student_id', $student->id)
                        ->where(
                            'academic_session_id',
                            $classRoom->academic_session_id
                        )
                        ->where(
                            'semester_id',
                            $classRoom->semester_id
                        )
                        ->first();


                    /*
                    |--------------------------------------------------------------------------
                    | Jika belum ada enrollment untuk semester tersebut
                    |--------------------------------------------------------------------------
                    */

                    if (! $studentEnrollment) {

                        $studentEnrollment = StudentEnrollment::create([
                            'student_id' => $student->id,

                            'academic_session_id' =>
                                $classRoom->academic_session_id,

                            'semester_id' =>
                                $classRoom->semester_id,

                            'class_room_id' =>
                                $classRoom->id,

                            'status' => 'Active',

                            'enrolled_at' => now(),
                        ]);

                    } else {

                        /*
                        * Kalau sudah ada enrollment untuk semester/session
                        * yang sama, kita update class sahaja.
                        */

                        $studentEnrollment->update([
                            'class_room_id' => $classRoom->id,
                            'status' => 'Active',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 2. Create Course Enrollment
                    |--------------------------------------------------------------------------
                    */

                    foreach ($validated['class_course_ids'] as $classCourseId) {

                        \App\Models\Enrollment::firstOrCreate(
                            [
                                'student_id' => $student->id,
                                'class_course_id' => $classCourseId,
                            ],
                            [
                                'status' => 1,
                            ]
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 3. Update current class student
                    |--------------------------------------------------------------------------
                    */

                    $student->update([
                        'class_room_id' => $classRoom->id,
                    ]);
                }
            });


            return redirect()
                ->route('student-enrollments.create')
                ->with(
                    'success',
                    'Students were enrolled in the selected class and courses successfully.'
                );
    }
}
