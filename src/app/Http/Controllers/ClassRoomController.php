<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\AcademicSession;
use App\Models\ClassRoom;
use App\Models\Programme;
use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassRoomController extends Controller
{
    public function index(Request $request): View
    {
        $query = ClassRoom::query()
            ->with([
                'academicSession',
                'semester',
                'programme',
            ]);

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhereHas('programme', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('academic_session_id')) {
            $query->where(
                'academic_session_id',
                $request->integer('academic_session_id')
            );
        }

        if ($request->filled('semester_id')) {
            $query->where(
                'semester_id',
                $request->integer('semester_id')
            );
        }

        if ($request->filled('programme_id')) {
            $query->where(
                'programme_id',
                $request->integer('programme_id')
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $classRooms = $query
            ->latest()
            ->paginate(10);

        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        $semesters = Semester::query()
            // ->orderBy('sequence')
            ->get();

        $programmes = Programme::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('class-rooms.index', compact(
            'classRooms',
            'academicSessions',
            'semesters',
            'programmes',
        ));
    }

    public function create(): View
    {
        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        $semesters = Semester::query()
            ->where('status', 'active')
            // ->orderBy('sequence')
            ->get();

        $programmes = Programme::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('class-rooms.create', compact(
            'academicSessions',
            'semesters',
            'programmes',
        ));
    }

    public function store(ClassRoomRequest $request): RedirectResponse
    {
        ClassRoom::create($request->validated());

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function show(ClassRoom $class): View
    {
        $class->load([
            'academicSession',
            'semester',
            'programme',
        ]);

        return view('class-rooms.show', [
            'classRoom' => $class,
        ]);
    }

    public function edit(ClassRoom $class): View
    {
        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        $semesters = Semester::query()
            ->where('status', true)
            // ->orderBy('sequence')
            ->get();

        $programmes = Programme::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('class-rooms.edit', compact(
            'class',
            'academicSessions',
            'semesters',
            'programmes',
        ));
    }

    public function update(
        ClassRoomRequest $request,
        ClassRoom $class
    ): RedirectResponse {
        $class->update($request->validated());

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassRoom $class): RedirectResponse
    {
        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
