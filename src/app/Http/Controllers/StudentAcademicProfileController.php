<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;

class StudentAcademicProfileController extends Controller
{
    public function show(Student $student): View
    {
        $student->load([
            'classRoom.academicSession',
            'classRoom.semester',
            'classRoom.programme',
            'enrollments.classCourse.course',
        ]);

        return view(
            'students.academic-profile',
            compact('student')
        );
    }
}
