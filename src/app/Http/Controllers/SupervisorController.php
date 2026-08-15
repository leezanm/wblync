<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupervisorRequest;
use App\Models\AcademicSession;
use App\Models\Lecturer;
use App\Models\Semester;
use App\Models\Supervisor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupervisorController extends Controller
{
    public function index(Request $request): View
    {
        $query = Supervisor::query()
            ->with([
                'lecturer',
                'academicSession',
                'semester',
            ])
            ->withCount('students');

        if ($request->filled('search')) {

            $search = $request->string('search')->trim();

            $query->whereHas('lecturer', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('staff_no', 'like', "%{$search}%");
            });
        }

        if ($request->filled('academic_session_id')) {
            $query->where(
                'academic_session_id',
                $request->academic_session_id
            );
        }

        if ($request->filled('semester_id')) {
            $query->where(
                'semester_id',
                $request->semester_id
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $supervisors = $query
            ->latest()
            ->paginate(10);

        $lecturers = Lecturer::query()
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        $semesters = Semester::query()
            ->orderBy('id')
            ->get();

        return view(
            'supervisors.index',
            compact(
                'supervisors',
                'lecturers',
                'academicSessions',
                'semesters'
            )
        );
    }

    public function create(): View
    {
        $lecturers = Lecturer::query()
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        $semesters = Semester::query()
            ->orderBy('id')
            ->get();

        return view(
            'supervisors.create',
            compact(
                'lecturers',
                'academicSessions',
                'semesters'
            )
        );
    }

    public function store(
        SupervisorRequest $request
    ): RedirectResponse {

        $supervisor = Supervisor::create(
            $request->validated()
        );

        return redirect()
            ->route('supervisors.show', $supervisor)
            ->with(
                'success',
                'Supervisor created successfully.'
            );
    }

  public function show(
    Supervisor $supervisor
    ): View {

        $supervisor->load([
            'lecturer',
            'academicSession',
            'semester',
            'students.student',
        ]);

        return view(
            'supervisors.show',
            compact('supervisor')
        );
    }

    public function edit(
        Supervisor $supervisor
    ): View {

        $lecturers = Lecturer::query()
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        $semesters = Semester::query()
            ->orderBy('id')
            ->get();

        return view(
            'supervisors.edit',
            compact(
                'supervisor',
                'lecturers',
                'academicSessions',
                'semesters'
            )
        );
    }

    public function update(
        SupervisorRequest $request,
        Supervisor $supervisor
    ): RedirectResponse {

        $supervisor->update(
            $request->validated()
        );

        return redirect()
            ->route('supervisors.show', $supervisor)
            ->with(
                'success',
                'Supervisor updated successfully.'
            );
    }

    public function destroy(
        Supervisor $supervisor
    ): RedirectResponse {

        $supervisor->delete();

        return redirect()
            ->route('supervisors.index')
            ->with(
                'success',
                'Supervisor deleted successfully.'
            );
    }

    public function addStudent(
    Supervisor $supervisor
    ): View {

        $supervisor->load([
            'lecturer',
            'academicSession',
            'semester',
        ]);

        $assignedStudentIds = $supervisor
            ->students()
            ->pluck('student_id');

        $students = \App\Models\Student::query()
            ->whereNotIn('id', $assignedStudentIds)
            ->orderBy('name')
            ->get();

        return view(
            'supervisors.add-student',
            compact(
                'supervisor',
                'students'
            )
        );
    }

    public function storeStudent(
    Request $request,
    Supervisor $supervisor
    ): RedirectResponse {

        $data = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
        ]);

        $alreadyAssigned = $supervisor
            ->students()
            ->where('student_id', $data['student_id'])
            ->exists();

        if ($alreadyAssigned) {
            return back()
                ->withErrors([
                    'student_id' => 'This student is already assigned to this supervisor.',
                ]);
        }

        $supervisor->students()->create([
            'student_id' => $data['student_id'],
            'assigned_at' => now(),
            'status' => 'Active',
        ]);

        return redirect()
            ->route('supervisors.show', $supervisor)
            ->with(
                'success',
                'Student assigned to supervisor successfully.'
            );
    }
}
