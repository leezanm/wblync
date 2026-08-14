<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $data = $request->validated();

        $student = DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('Student');

            return Student::create([
                'uuid' => (string) Str::uuid(),
                'user_id' => $user->id,
                'class_room_id' => $data['class_room_id'] ?? null,
                'student_no' => $data['student_no'],
                'name' => $data['name'],
                'ic_no' => $data['ic_no'] ?? null,
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'] ?? 1,
            ]);
        });

        return redirect()
            ->route('students.show', $student)
            ->with(
                'success',
                'Student created successfully. A user account has also been created.'
            );
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
        $data = $request->validated();

        DB::transaction(function () use ($data, $student) {

            $student->update($data);

            if ($student->user) {
                $student->user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
            }
        });

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(
        Student $student
    ): RedirectResponse {

        if ($student->placements()->exists()) {
            return back()->withErrors([
                'student' => 'This student cannot be deleted because placement records already exist.',
            ]);
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with(
                'success',
                'Student deleted successfully.'
            );
    }
}
