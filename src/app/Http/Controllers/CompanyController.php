<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(Request $request): View
    {
        $query = Company::query();

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query
                    ->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('registration_no', 'like', "%{$search}%")
                    ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where(
                'status',
                $request->boolean('status')
            );
        }

        $companies = $query
            ->latest()
            ->paginate(10);

        return view(
            'companies.index',
            compact('companies')
        );
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(
        CompanyRequest $request
    ): RedirectResponse {
        Company::create([
            ...$request->validated(),
            'uuid' => (string) str()->uuid(),
        ]);

        return redirect()
            ->route('companies.index')
            ->with(
                'success',
                'Company created successfully.'
            );
    }

    public function show(
        Company $company
    ): View {
        return view(
            'companies.show',
            compact('company')
        );
    }

    public function edit(
        Company $company
    ): View {
        return view(
            'companies.edit',
            compact('company')
        );
    }

    public function update(
        CompanyRequest $request,
        Company $company
    ): RedirectResponse {
        $company->update(
            $request->validated()
        );

        return redirect()
            ->route('companies.index')
            ->with(
                'success',
                'Company updated successfully.'
            );
    }

    public function destroy(
        Company $company
    ): RedirectResponse {
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with(
                'success',
                'Company deleted successfully.'
            );
    }
}
