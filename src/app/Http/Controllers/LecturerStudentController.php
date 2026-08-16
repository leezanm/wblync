<?php

namespace App\Http\Controllers;

use App\Models\SupervisorStudent;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LecturerStudentController extends Controller
{
    public function index(Request $request): View
    {
        $lecturer = $request->user()->lecturer;
        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $students = SupervisorStudent::query()
            ->whereHas('supervisor', function ($query) use ($lecturer) {
                $query->where(
                    'lecturer_id',
                    $lecturer->id
                );
            })
            ->where('status', 'Active')
            ->with([
                'student',
                'supervisor',
            ])
            ->latest('assigned_at')
            ->paginate(12)
            ->withQueryString();
        return view(
            'lecturers.students.index',
            compact('students')
        );
    }
}
