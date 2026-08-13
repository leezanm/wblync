<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyContactRequest;
use App\Models\Company;
use App\Models\CompanyContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = CompanyContact::query()
            ->with('company');

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($query) use ($search) {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $contacts = $query
            ->latest()
            ->paginate(10);

        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'company-contacts.index',
            compact('contacts', 'companies')
        );
    }

    public function create(): View
    {
        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'company-contacts.create',
            compact('companies')
        );
    }

    public function store(
        CompanyContactRequest $request
    ): RedirectResponse {
        CompanyContact::create(
            $request->validated()
        );

        return redirect()
            ->route('company-contacts.index')
            ->with(
                'success',
                'Company contact created successfully.'
            );
    }

    public function show(
        CompanyContact $companyContact
    ): View {
        $companyContact->load('company');

        return view(
            'company-contacts.show',
            compact('companyContact')
        );
    }

    public function edit(
        CompanyContact $companyContact
    ): View {
        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'company-contacts.edit',
            compact(
                'companyContact',
                'companies'
            )
        );
    }

    public function update(
        CompanyContactRequest $request,
        CompanyContact $companyContact
    ): RedirectResponse {
        $companyContact->update(
            $request->validated()
        );

        return redirect()
            ->route('company-contacts.index')
            ->with(
                'success',
                'Company contact updated successfully.'
            );
    }

    public function destroy(
        CompanyContact $companyContact
    ): RedirectResponse {
        $companyContact->delete();

        return redirect()
            ->route('company-contacts.index')
            ->with(
                'success',
                'Company contact deleted successfully.'
            );
    }
}
