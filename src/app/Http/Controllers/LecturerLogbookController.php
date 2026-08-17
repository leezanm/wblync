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

        $logbooks = DailyLogbook::query()
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
            ])
            ->latest('log_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'lecturers.students.logbooks.index',
            compact(
                'student',
                'logbooks'
            )
        );
    }

    public function show(
        Request $request,
        Student $student,
        DailyLogbook $dailyLogbook
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
        | Make sure daily logbook belongs to this student
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $dailyLogbook->placement
                && $dailyLogbook->placement->student_id === $student->id,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Only submitted / approved / rejected records are visible
        |--------------------------------------------------------------------------
        */

        abort_unless(
            in_array($dailyLogbook->status, [
                'Submitted',
                'Approved',
                'Rejected',
            ]),
            404
        );

        $dailyLogbook->load([
            'placement.student',
            'placement.company',
            'placement.companyContact',
            'placement.academicSession',
        ]);

        return view(
            'lecturers.students.logbooks.show',
            compact(
                'student',
                'dailyLogbook'
            )
        );
    }
}
