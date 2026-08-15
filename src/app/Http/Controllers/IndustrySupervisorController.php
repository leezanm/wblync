<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustrySupervisorRequest;
use App\Models\Company;
use App\Models\IndustrySupervisor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        $data = $request->validated();

        $industrySupervisor = DB::transaction(function () use ($data) {

            // Create User
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
            ]);

            // Assign role kepada User
            $user->assignRole('Industry Mentor');

            // Create Industry Supervisor
            return IndustrySupervisor::create([
                'user_id' => $user->id,
                'company_id' => $data['company_id'],
                'name' => $data['name'],
                'position' => $data['position'] ?? null,
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);
        });

        return redirect()
            ->route('industry-supervisors.show', $industrySupervisor)
            ->with(
                'success',
                'Industry Supervisor created successfully.'
            );
    }


    public function show(
    IndustrySupervisor $industrySupervisor
    ): View {

        $industrySupervisor->load([
            'user',
            'company',
        ]);

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


        $data = $request->validated();

        $industrySupervisor->update([
            'name' => $data['name'],
            'company_id' => $data['company_id'],
            'position' => $data['position'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'status' => $data['status'],
        ]);

        $industrySupervisor->user?->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);


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

    public function students(Request $request): View
    {
        $user = $request->user();

        $industrySupervisor = $user
            ->industrySupervisor;

        abort_unless(
            $industrySupervisor,
            403
        );

        $placements = $industrySupervisor
            ->placements()
            ->with([
                'student',
                'company',
                'academicSession',
            ])
            ->latest()
            ->paginate(12);

        return view(
            'industry-supervisors.students',
            compact(
                'industrySupervisor',
                'placements'
            )
        );
    }
}
