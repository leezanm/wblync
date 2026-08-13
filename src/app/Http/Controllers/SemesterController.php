<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Models\AcademicSession;
use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SemesterController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $semesters = Semester::query()
            ->with('academicSession')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('code', 'like', '%'.$search.'%')
                        ->orWhere('name', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('semesters.index', compact('semesters'));
    }

    public function create(): View
    {
        return view('semesters.create', [
            'academicSessions' => AcademicSession::query()->orderBy('name')->get(),
            'nextCode' => $this->generateNextCode(),
        ]);
    }

    public function store(SemesterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['code'] = $this->generateNextCode();
        $data['created_by'] = Auth::id();
        if (! empty($data['current'])) {
            Semester::query()->update(['current' => false]);
        }

        Semester::create($data);

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester created successfully.');
    }

    public function show(Semester $semester): View
    {
        $semester->load('academicSession');

        return view('semesters.show', compact('semester'));
    }

    public function edit(Semester $semester): View
    {
        return view('semesters.edit', [
            'semester' => $semester,
            'academicSessions' => AcademicSession::query()->orderBy('name')->get(),
        ]);
    }

    public function update(SemesterRequest $request, Semester $semester): RedirectResponse
    {
        $data = $request->validated();
        unset($data['code']);

        if (! empty($data['current'])) {
            Semester::query()
                ->whereKeyNot($semester->getKey())
                ->update(['current' => false]);
        }

        $semester->update($data);

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester updated successfully.');
    }

    public function destroy(Semester $semester): RedirectResponse
    {
        $semester->delete();

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester deleted successfully.');
    }

    protected function generateNextCode(): string
    {
        $lastCode = Semester::withTrashed()
            ->whereRaw("code REGEXP '^[0-9]+$'")
            ->orderByRaw('CAST(code AS UNSIGNED) DESC')
            ->value('code');

        $nextNumber = ((int) $lastCode) + 1;

        return str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function byAcademicSession(AcademicSession $academicSession)
    {
        return response()->json(
            $academicSession
                ->semesters()
                ->where('status', 'Active')
                ->orderBy('id')
                ->get([
                    'id',
                    'name',
                    'code',
                    'start_date',
                    'end_date',
                ]));
    }
}
