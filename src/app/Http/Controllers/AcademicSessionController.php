<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicSessionRequest;
use App\Models\AcademicSession;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    // public function index(Request $request)
    // {
    //     $sessions = AcademicSession::query()

    //     ->when($request->search,function($query) use($request){

    //         $query->where('code','like','%'.$request->search.'%')

    //             ->orWhere('name','like','%'.$request->search.'%');

    //     })

    //     ->latest()

    //     ->paginate(10)

    //     ->withQueryString();

    //     return view(

    //         'academic-sessions.index',

    //         compact('sessions')

    //     );
    // }

    // public function index(Request $request)
    // {
    //     $sessions = AcademicSession::query()
    //         ->when($request->filled('search'), function ($query) use ($request) {
    //             $search = $request->search;

    //             $query->where(function ($subQuery) use ($search) {
    //                 $subQuery->where('code', 'like', '%' . $search . '%')
    //                     ->orWhere('name', 'like', '%' . $search . '%');
    //             });
    //         })
    //         ->latest()
    //         ->paginate(10)
    //         ->withQueryString();

    //     return view('academic-sessions.index', compact('sessions'));
    // }

    public function index(Request $request)
    {
        $sessions = AcademicSession::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim((string) $request->input('search'));

                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('code', 'like', '%'.$search.'%')
                        ->orWhere('name', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('academic-sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('academic-sessions.create', [
            'nextCode' => $this->generateNextCode(),
        ]);
    }

    public function store(AcademicSessionRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $this->generateNextCode();

        $data['created_by'] = auth()->id();

        if (! empty($data['current'])) {

            AcademicSession::query()->update([
                'current' => false,
            ]);

        }

        AcademicSession::create($data);

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic Session created successfully.');
    }

    public function show(AcademicSession $academicSession)
    {
        // display the details of a specific academic session

        return view(
            'academic-sessions.show',
            compact('academicSession')
        );
    }

    public function edit(AcademicSession $academicSession)
    {
        return view(
            'academic-sessions.edit',
            compact('academicSession')
        );
    }

    public function update(
        AcademicSessionRequest $request,
        AcademicSession $academicSession
    ) {

        $data = $request->validated();
        unset($data['code']);

        if (! empty($data['current'])) {

            AcademicSession::query()->update([
                'current' => false,
            ]);

        }

        $academicSession->update($data);

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic Session updated successfully.');

    }

    public function destroy(AcademicSession $academicSession)
    {
        if ($academicSession->current) {
            return redirect()
                ->route('academic-sessions.index')
                ->with('error', 'Current Academic Session cannot be deleted.');
        }

        $academicSession->delete();

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic Session deleted successfully.');
    }

    protected function generateNextCode(): string
    {
        $lastCode = AcademicSession::withTrashed()
            ->whereRaw("code REGEXP '^[0-9]+$'")
            ->orderByRaw('CAST(code AS UNSIGNED) DESC')
            ->value('code');

        $nextNumber = ((int) $lastCode) + 1;

        return str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
