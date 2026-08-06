<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Http\Requests\AcademicSessionRequest;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    public function index(Request $request)
{
    $sessions = AcademicSession::query()

        ->when($request->search,function($query) use($request){

            $query->where('code','like','%'.$request->search.'%')

                ->orWhere('name','like','%'.$request->search.'%');

        })

        ->latest()

        ->paginate(10)

        ->withQueryString();

    return view(

        'academic-sessions.index',

        compact('sessions')

    );
}

    public function create()
    {
        return view('academic-sessions.create');
    }

    public function store(AcademicSessionRequest $request)
    {
        $data = $request->validated();

        $data['created_by'] = auth()->id();

        if (!empty($data['current'])) {

            AcademicSession::query()->update([
                'current' => false
            ]);

        }

        AcademicSession::create($data);

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic Session created successfully.');
    }

    public function show(AcademicSession $academicSession)
    {
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

        if (!empty($data['current'])) {

            AcademicSession::query()->update([
                'current' => false
            ]);

        }

        $academicSession->update($data);

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic Session updated successfully.');

    }

    public function destroy(AcademicSession $academicSession)
    {
        $academicSession->delete();

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic Session deleted successfully.');
    }
}
