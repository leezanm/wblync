<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Placement Details
                </h2>

            </div>


            <a
                href="{{ route('placements.edit', $placement) }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                    />
                </svg>

                Edit Placement

            </a>

        </div>

    </x-slot>


    {{-- Page Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Placement Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                View student WBL placement details.
            </p>

        </div>

    </div>

    @if (session('success'))
        <div class="mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->has('status'))
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm font-medium text-red-800">
            {{ $errors->first('status') }}
        </div>
    @endif


    {{-- Student Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-blue-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M4.5 20.25a7.5 7.5 0 0115 0"
                    />
                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Student Information
                </h3>

                <p class="text-sm text-slate-500">
                    Student assigned to this placement.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Student No.
                </p>

                <p class="mt-2 font-bold text-blue-600">
                    {{ $placement->student->student_no }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Student Name
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $placement->student->name }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Student Status
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $placement->student->status ? 'Active' : 'Inactive' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Company Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-indigo-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2M9 11h2M9 15h2M15 7h2M15 11h2M15 15h2"
                    />
                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Company Information
                </h3>

                <p class="text-sm text-slate-500">
                    Industry company for this placement.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Company Code
                </p>

                <p class="mt-2 font-bold text-blue-600">
                    {{ $placement->company->code }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Company Name
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $placement->company->name }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Industry
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $placement->company->industry ?: '-' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Email
                </p>

                <p class="mt-2 font-semibold text-slate-800 break-all">
                    {{ $placement->company->email ?: '-' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Phone
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $placement->company->phone ?: '-' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    State
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $placement->company->state ?: '-' }}
                </p>

            </div>

        </div>

    </div>

    @if ($placement->companyContact)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">

                    <svg
                        class="w-5 h-5 text-amber-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4.5 20.25a7.5 7.5 0 0115 0"
                        />
                    </svg>

                </div>

                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Company Contact
                    </h3>

                    <p class="text-sm text-slate-500">
                        Contact person responsible for this placement.
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-2 font-bold text-slate-800">
                        {{ $placement->companyContact->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Position
                    </p>

                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $placement->companyContact->position ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Email
                    </p>

                    <p class="mt-2 font-semibold text-slate-800 break-all">
                        {{ $placement->companyContact->email ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Phone
                    </p>

                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $placement->companyContact->phone ?: '-' }}
                    </p>
                </div>

            </div>

        </div>

    @endif

    @if ($placement->industrySupervisor)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center">
                    <svg
                        class="w-5 h-5 text-cyan-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3.75 20.25a8.25 8.25 0 0116.5 0"
                        />
                    </svg>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-slate-800">
                        Industry Supervisor
                    </h3>

                    <p class="text-sm text-slate-500">
                        Supervisor assigned for this placement.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-2 font-bold text-slate-800">
                        {{ $placement->industrySupervisor->name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Position
                    </p>

                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $placement->industrySupervisor->position ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Email
                    </p>

                    <p class="mt-2 font-semibold text-slate-800 break-all">
                        {{ $placement->industrySupervisor->email ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Phone
                    </p>

                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $placement->industrySupervisor->phone ?: '-' }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- Academic Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-purple-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 14l9-5-9-5-9 5 9 5z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M5 12v4.5c0 .83 3.13 2.5 7 2.5s7-1.67 7-2.5V12"
                    />

                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Academic Information
                </h3>

                <p class="text-sm text-slate-500">
                    Academic session associated with this placement.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Academic Session
                </p>

                <p class="mt-2 font-bold text-slate-800">
                    {{ $placement->academicSession->name }}
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $placement->academicSession->code }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Placement ID
                </p>

                <p class="mt-2 font-bold text-blue-600">
                    {{ $placement->uuid }}
                </p>

            </div>

        </div>

    </div>


    {{-- Placement Period --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M6.75 3v3M17.25 3v3M3.75 9h16.5M5.25 5.25h13.5A1.5 1.5 0 0120.25 6.75v12A1.5 1.5 0 0118.75 20.25H5.25a1.5 1.5 0 01-1.5-1.5v-12a1.5 1.5 0 011.5-1.5z"
                    />
                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Placement Period
                </h3>

                <p class="text-sm text-slate-500">
                    Duration and current placement status.
                </p>

            </div>

        </div>


        @php

            $statusClasses = [
                'Draft' => 'bg-slate-100 text-slate-600',
                'Applied' => 'bg-blue-100 text-blue-700',
                'Approved' => 'bg-indigo-100 text-indigo-700',
                'Rejected' => 'bg-red-100 text-red-700',
                'Active' => 'bg-green-100 text-green-700',
                'Completed' => 'bg-purple-100 text-purple-700',
                'Cancelled' => 'bg-orange-100 text-orange-700',
            ];

        @endphp


        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Start Date
                </p>

                <p class="mt-2 font-bold text-slate-800">
                    {{ $placement->start_date->format('d/m/Y') }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    End Date
                </p>

                <p class="mt-2 font-bold text-slate-800">
                    {{ $placement->end_date->format('d/m/Y') }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Status
                </p>

                <div class="mt-2">

                    <span
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses[$placement->status] ?? 'bg-slate-100 text-slate-600' }}"
                    >

                        <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                        {{ $placement->status }}

                    </span>

                </div>

            </div>

        </div>

    </div>

    {{-- Status Actions --}}
    @php
        $statusActions = [
            'Draft' => [
                [
                    'status' => 'Applied',
                    'label' => 'Submit Application',
                    'class' => 'bg-blue-600 hover:bg-blue-700',
                    'confirm' => 'Submit this placement application?',
                ],
            ],

            'Applied' => [
                [
                    'status' => 'Approved',
                    'label' => 'Approve',
                    'class' => 'bg-green-600 hover:bg-green-700',
                    'confirm' => 'Approve this placement?',
                ],
                [
                    'status' => 'Rejected',
                    'label' => 'Reject',
                    'class' => 'bg-red-600 hover:bg-red-700',
                    'confirm' => 'Reject this placement?',
                ],
            ],

            'Approved' => [
                [
                    'status' => 'Active',
                    'label' => 'Activate Placement',
                    'class' => 'bg-green-600 hover:bg-green-700',
                    'confirm' => 'Activate this placement?',
                ],
                [
                    'status' => 'Cancelled',
                    'label' => 'Cancel Placement',
                    'class' => 'bg-red-600 hover:bg-red-700',
                    'confirm' => 'Cancel this placement?',
                ],
            ],

            'Active' => [
                [
                    'status' => 'Completed',
                    'label' => 'Complete Placement',
                    'class' => 'bg-purple-600 hover:bg-purple-700',
                    'confirm' => 'Mark this placement as completed?',
                ],
                [
                    'status' => 'Cancelled',
                    'label' => 'Cancel Placement',
                    'class' => 'bg-red-600 hover:bg-red-700',
                    'confirm' => 'Cancel this placement?',
                ],
            ],
        ];

        $availableActions = $statusActions[$placement->status] ?? [];
    @endphp

    @role('Super Admin')
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Placement Workflow
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Manage the current status of this WBL placement.
                </p>

            </div>


            <div class="flex flex-wrap items-center gap-3">

                @forelse ($availableActions as $action)

                    <form
                        method="POST"
                        action="{{ route('placements.status', $placement) }}"
                        onsubmit="return confirm('{{ $action['confirm'] }}');"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="{{ $action['status'] }}"
                        >

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-white font-semibold transition shadow-sm {{ $action['class'] }}"
                        >
                            {{ $action['label'] }}
                        </button>

                    </form>

                @empty

                    <span class="inline-flex items-center px-4 py-2.5 rounded-xl bg-slate-100 text-sm font-medium text-slate-500">
                        No further action available
                    </span>

                @endforelse

            </div>

        </div>

    </div>

    {{-- Remarks --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <h3 class="text-lg font-bold text-slate-800">
            Remarks
        </h3>

        <div class="mt-4 rounded-xl bg-slate-50 border border-slate-100 p-4">

            @if ($placement->remarks)

                <p class="text-sm text-slate-700 whitespace-pre-line">
                    {{ $placement->remarks }}
                </p>

            @else

                <p class="text-sm text-slate-400">
                    No remarks provided.
                </p>

            @endif

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('placements.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Placements
        </a>


        <a
            href="{{ route('placements.edit', $placement) }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
        >
            Edit Placement
        </a>

    </div>
    @endrole
</x-app-layout>
