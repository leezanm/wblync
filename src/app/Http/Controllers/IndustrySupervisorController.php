<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustrySupervisorRequest;
use App\Models\Company;
use App\Models\IndustrySupervisor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndustrySupervisorController extends Controller
{
    public function index(Request $request): View
    {
        $query = IndustrySupervisor::query()
            ->with('company');



        if ($request->filled('search')) {

            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {

                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($query) use ($search) {

                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");

                    });

            });
        }


        if ($request->filled('company_id')) {
            $query->where(
                'company_id',
                $request->integer('company_id')
            );
        }


        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        $supervisors = $query
            ->latest()
            ->paginate(10);


        $companies = Company::query()
            ->orderBy('name')
            ->get();


        return view(
            'industry-supervisors.index',
            compact(
                'supervisors',
                'companies'
            )
        );
    }


    public function create(): View
    {
        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'industry-supervisors.create',
            compact(
                'companies',
            )
        );
    }


    public function store(
        IndustrySupervisorRequest $request
    ): RedirectResponse {

        $supervisor = IndustrySupervisor::create(
            $request->validated()
        );


        return redirect()
            ->route(
                'industry-supervisors.show',
                $supervisor
            )
            ->with(
                'success',
                'Industry supervisor created successfully.'
            );
    }


    public function show(
        IndustrySupervisor $industrySupervisor
    ): View {
        $industrySupervisor->load('company');


        return view(
            'industry-supervisors.show',
            compact('industrySupervisor')
        );
    }


    public function edit(
        IndustrySupervisor $industrySupervisor
    ): View {
        $companies = Company::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'industry-supervisors.edit',
            compact(
                'industrySupervisor',
                'companies',
            )
        );
    }


    public function update(
        IndustrySupervisorRequest $request,
        IndustrySupervisor $industrySupervisor
    ): RedirectResponse {

        $industrySupervisor->update(
            $request->validated()
        );


        return redirect()
            ->route(
                'industry-supervisors.show',
                $industrySupervisor
            )
            ->with(
                'success',
                'Industry supervisor updated successfully.'
            );
    }


    public function destroy(
        IndustrySupervisor $industrySupervisor
    ): RedirectResponse {

        $industrySupervisor->delete();


        return redirect()
            ->route('industry-supervisors.index')
            ->with(
                'success',
                'Industry supervisor deleted successfully.'
            );
    }
}
