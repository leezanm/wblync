<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgrammeRequest;
use App\Models\Programme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Programme::query();

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $programmes = $query
            ->orderBy('code')
            ->paginate(10);

        return view('programmes.index', compact('programmes'));
    }

    public function create(): View
    {
        return view('programmes.create');
    }

    public function store(ProgrammeRequest $request): RedirectResponse
    {
        Programme::create($request->validated());

        return redirect()
            ->route('programmes.index')
            ->with('success', 'Programme created successfully.');
    }

    public function show(Programme $programme): View
    {
        return view('programmes.show', compact('programme'));
    }

    public function edit(Programme $programme): View
    {
        return view('programmes.edit', compact('programme'));
    }

    public function update(
        ProgrammeRequest $request,
        Programme $programme
    ): RedirectResponse {
        $programme->update($request->validated());

        return redirect()
            ->route('programmes.index')
            ->with('success', 'Programme updated successfully.');
    }

    public function destroy(Programme $programme): RedirectResponse
    {
        $programme->delete();

        return redirect()
            ->route('programmes.index')
            ->with('success', 'Programme deleted successfully.');
    }
}
