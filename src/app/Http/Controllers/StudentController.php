<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::query()
            ->with([
                'classRoom.academicSession',
                'classRoom.semester',
                'classRoom.programme',
            ]);

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query
                    ->where('student_no', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('ic_no', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_room_id')) {
            $query->where(
                'class_room_id',
                $request->integer('class_room_id')
            );
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $students = $query
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

        return view('students.index', compact(
            'students',
            'classRooms',
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

        return view('students.create', compact(
            'classRooms',
        ));
    }

    public function store(StudentRequest $request): RedirectResponse
    {
        Student::create(
            $request->validated()
        );

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student): View
    {
        $student->load([
            'classRoom.academicSession',
            'classRoom.semester',
            'classRoom.programme',
        ]);

        return view('students.show', compact(
            'student',
        ));
    }

    public function edit(Student $student): View
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

        return view('students.edit', compact(
            'student',
            'classRooms',
        ));
    }

    public function update(
        StudentRequest $request,
        Student $student
    ): RedirectResponse {
        $student->update(
            $request->validated()
        );

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
