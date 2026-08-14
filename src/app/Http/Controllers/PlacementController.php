<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacementRequest;
use App\Models\AcademicSession;
use App\Models\Company;
use App\Models\Placement;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlacementController extends Controller
{
    public function index(Request $request): View
    {
        $query = Placement::query()
            ->with([
                'student',
                'company',
                'academicSession',
            ]);

        $studentUser = auth()->user()?->hasRole('Student')
            ? auth()->user()?->student
            : null;

        if ($studentUser) {
            $query->where('student_id', $studentUser->id);
        } elseif ($request->filled('student_id')) {
            $query->where('student_id', $request->integer('student_id'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query
                    ->whereHas('student', function ($query) use ($search) {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere(
                                'student_no',
                                'like',
                                "%{$search}%"
                            );
                    })
                    ->orWhereHas('company', function ($query) use ($search) {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere(
                                'code',
                                'like',
                                "%{$search}%"
                            );
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->string('status')
            );
        }

        if ($request->filled('academic_session_id')) {
            $query->where(
                'academic_session_id',
                $request->academic_session_id
            );
        }

        $placements = $query
            ->latest()
            ->paginate(10);

        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        return view(
            'placements.index',
            compact(
                'placements',
                'academicSessions'
            )
        );

        // return view(
        //     'placements.index',
        //     compact('placements')
        // );
    }

    public function create(): View
    {
        $students = Student::query()
            ->orderBy('name')
            ->get();

        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        $companyContacts = CompanyContact::query()
            ->where('status', 'Active')
            ->with('company')
            ->orderBy('name')
            ->get();

        return view('placements.create', compact(
            'students',
            'companies',
            'academicSessions',
            'companyContacts',
        ));
    }
    // public function create(): View
    // {
    //     $students = Student::query()
    //         ->orderBy('name')
    //         ->get();

    //     $companies = Company::query()
    //         ->where('status', true)
    //         ->orderBy('name')
    //         ->get();

    //     $academicSessions = AcademicSession::query()
    //         ->orderByDesc('start_date')
    //         ->get();

    //     $statuses = [
    //         'Draft',
    //         'Applied',
    //         'Approved',
    //         'Rejected',
    //         'Active',
    //         'Completed',
    //         'Cancelled',
    //     ];

    //     return view(
    //         'placements.create',
    //         compact(
    //             'students',
    //             'companies',
    //             'academicSessions',
    //             'statuses'
    //         )
    //     );
    // }

    public function store(
        PlacementRequest $request
    ): RedirectResponse {
        Placement::create([
            ...$request->validated(),
            'uuid' => (string) str()->uuid(),

        ]);

        return redirect()
            ->route('placements.index')
            ->with(
                'success',
                'Placement created successfully.'
            );
    }

    public function show(Placement $placement): View
    {
        $placement->load([
            'student',
            'company',
            'companyContact',
            'academicSession',
        ]);

        return view(
            'placements.show',
            compact('placement')
        );
    }

    public function edit(Placement $placement): View
    {
        $students = Student::query()
            ->orderBy('name')
            ->get();

        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('start_date')
            ->get();

        $companyContacts = CompanyContact::query()
            ->where('status', 'Active')
            ->with('company')
            ->orderBy('name')
            ->get();

        return view('placements.edit', compact(
            'placement',
            'students',
            'companies',
            'academicSessions',
            'companyContacts',
        ));
    }
    // public function edit(
    //     Placement $placement
    // ): View {
    //     $students = Student::query()
    //         ->orderBy('name')
    //         ->get();

    //     $companies = Company::query()
    //         ->where('status', true)
    //         ->orderBy('name')
    //         ->get();

    //     $academicSessions = AcademicSession::query()
    //         ->orderByDesc('start_date')
    //         ->get();

    //     $statuses = [
    //         'Draft',
    //         'Applied',
    //         'Approved',
    //         'Rejected',
    //         'Active',
    //         'Completed',
    //         'Cancelled',
    //     ];

    //     return view(
    //         'placements.edit',
    //         compact(
    //             'placement',
    //             'students',
    //             'companies',
    //             'academicSessions',
    //             'statuses'
    //         )
    //     );
    // }

    public function update(
        PlacementRequest $request,
        Placement $placement
    ): RedirectResponse {
        $placement->update(
            $request->validated()
        );

        return redirect()
            ->route('placements.index')
            ->with(
                'success',
                'Placement updated successfully.'
            );
    }

    public function updateStatus(
        Request $request,
        Placement $placement
    ): RedirectResponse {
        $request->validate([
            'status' => [
                'required',
                'string',
                'in:Draft,Applied,Approved,Rejected,Active,Completed,Cancelled',
            ],
        ]);

        $newStatus = $request->string('status')->toString();

        if (! $placement->canChangeStatusTo($newStatus)) {
            return back()
                ->withErrors([
                    'status' => "Placement cannot be changed from {$placement->status} to {$newStatus}.",
                ]);
        }

        $placement->update([
            'status' => $newStatus,
        ]);

        return back()->with(
            'success',
            "Placement status updated to {$newStatus}."
        );
    }

    public function destroy(
        Placement $placement
    ): RedirectResponse {
        $placement->delete();

        return redirect()
            ->route('placements.index')
            ->with(
                'success',
                'Placement deleted successfully.'
            );
    }
}
