<?php

namespace App\Http\Controllers;

use App\Models\DailyLogbook;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LecturerLogbookController extends Controller
{
    public function index(
    Request $request,
    Student $student
    ): View {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure this student belongs to the lecturer
        |--------------------------------------------------------------------------
        */

        $isAssigned = $lecturer
            ->supervisors()
            ->whereHas('students', function ($query) use ($student) {
                $query
                    ->where('student_id', $student->id)
                    ->where('status', 'Active');
            })
            ->exists();

        abort_unless(
            $isAssigned,
            403,
            'You are not authorised to view this student.'
        );

        /*
        |--------------------------------------------------------------------------
        | Get Weekly Submitted Logbooks
        |--------------------------------------------------------------------------
        */

        $submissions = \App\Models\WeeklyLogbookSubmission::query()
            ->whereHas('placement', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->whereIn('status', [
                'Submitted',
                'Approved',
                'Rejected',
            ])
            ->with([
                'placement.company',
                'dailyLogbooks' => function ($query) {
                    $query->orderBy('log_date');
                },
            ])
            ->latest('week_start_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'lecturers.students.logbooks.index',
            compact(
                'student',
                'submissions'
            )
        );
    }

    public function show(
    Request $request,
    Student $student,
    \App\Models\WeeklyLogbookSubmission $weeklyLogbookSubmission
    ): View {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure student belongs to this lecturer
        |--------------------------------------------------------------------------
        */

        $isAssigned = $lecturer
            ->supervisors()
            ->whereHas('students', function ($query) use ($student) {
                $query
                    ->where('student_id', $student->id)
                    ->where('status', 'Active');
            })
            ->exists();

        abort_unless(
            $isAssigned,
            403,
            'You are not authorised to view this student.'
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure weekly submission belongs to this student
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $weeklyLogbookSubmission->placement
                && $weeklyLogbookSubmission->placement->student_id === $student->id,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Only submitted / approved / rejected records are visible
        |--------------------------------------------------------------------------
        */

        abort_unless(
            in_array($weeklyLogbookSubmission->status, [
                'Submitted',
                'Approved',
                'Rejected',
            ]),
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Load weekly records
        |--------------------------------------------------------------------------
        */

        $weeklyLogbookSubmission->load([
            'placement.student',
            'placement.company',
            'dailyLogbooks' => function ($query) {
                $query->orderBy('log_date');
            },
        ]);

        return view(
            'lecturers.students.logbooks.show',
            compact(
                'student',
                'weeklyLogbookSubmission'
            )
        );
    }
}
