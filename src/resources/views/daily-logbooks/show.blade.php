<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Daily Logbook Details
                </h2>

            </div>

            @if ($dailyLogbook->status !== 'Approved')

                <a
                    href="{{ route('daily-logbooks.edit', $dailyLogbook) }}"
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
                            d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                        />
                    </svg>

                    Edit Logbook

                </a>

            @endif

            {{-- <a
                href="{{ route('daily-logbooks.edit', $dailyLogbook) }}"
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
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                    />
                </svg>

                Edit Logbook

            </a> --}}

        </div>

    </x-slot>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    @php

        $statusClasses = [
            'Draft' => 'bg-slate-100 text-slate-600',
            'Submitted' => 'bg-blue-100 text-blue-700',
            'Approved' => 'bg-green-100 text-green-700',
            'Rejected' => 'bg-red-100 text-red-700',
        ];

    @endphp


    {{-- Student / Company Summary --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div class="flex items-start gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">

                    <svg
                        class="w-6 h-6 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 3.75h9.5L19 7.25v13H6a2 2 0 01-2-2v-12.5a2 2 0 012-2z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 3.75v4h4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8.5 11h7M8.5 14.5h7M8.5 18h4"
                        />

                    </svg>

                </div>


                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Daily Logbook
                    </p>

                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 mt-1">
                        {{ $dailyLogbook->placement->student->name }}
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $dailyLogbook->placement->student->student_no }}
                    </p>

                </div>

            </div>


            <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                <div class="text-sm text-slate-500">

                    {{ $dailyLogbook->log_date->format('d/m/Y') }}

                </div>


                <span
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $statusClasses[$dailyLogbook->status] ?? 'bg-slate-100 text-slate-600' }}"
                >

                    <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                    {{ $dailyLogbook->status }}

                </span>

            </div>

        </div>

    </div>


    {{-- Logbook Information --}}
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
                        d="M6 3.75h9.5L19 7.25v13H6a2 2 0 01-2-2v-12.5a2 2 0 012-2z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 3.75v4h4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8.5 11h7M8.5 14.5h7M8.5 18h4"
                    />

                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Logbook Information
                </h3>

                <p class="text-sm text-slate-500">
                    Daily activity and learning record.
                </p>

            </div>

        </div>


        {{-- Date / Hours / Status --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pb-6 border-b border-slate-100">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Log Date
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $dailyLogbook->log_date->format('d/m/Y') }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Working Hours
                </p>

                <p class="mt-2 font-semibold text-slate-800">

                    @if ($dailyLogbook->working_hours !== null)

                        {{ number_format((float) $dailyLogbook->working_hours, 2) }}
                        hrs

                    @else

                        -

                    @endif

                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Status
                </p>

                <span
                    class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses[$dailyLogbook->status] ?? 'bg-slate-100 text-slate-600' }}"
                >

                    <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                    {{ $dailyLogbook->status }}

                </span>

            </div>

        </div>


        {{-- Activity --}}
        <div class="mt-6">

            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                Daily Activity
            </p>

            <div class="mt-3 rounded-xl bg-slate-50 border border-slate-100 p-5">

                <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                    {{ $dailyLogbook->activity }}
                </p>

            </div>

        </div>


        {{-- Learning Outcome --}}
        <div class="mt-6">

            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                Learning Outcome
            </p>

            <div class="mt-3 rounded-xl bg-slate-50 border border-slate-100 p-5">

                @if ($dailyLogbook->learning_outcome)

                    <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                        {{ $dailyLogbook->learning_outcome }}
                    </p>

                @else

                    <p class="text-sm text-slate-400">
                        No learning outcome recorded.
                    </p>

                @endif

            </div>

        </div>


        {{-- Weekend Summary --}}
        <div class="mt-6">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Weekend Summary
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Weekly or weekend reflection attached to this logbook entry.
                    </p>
                </div>

                <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5">
                    <input
                        type="checkbox"
                        disabled
                        @checked(filled($dailyLogbook->weekly_summary))
                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    >
                    <span class="text-sm font-medium text-slate-700">
                        Weekend summary enabled
                    </span>
                </label>
            </div>

            <div class="mt-3 rounded-xl border border-red-100 bg-red-50 p-5">

                @if ($dailyLogbook->weekly_summary)

                    <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                        {{ $dailyLogbook->weekly_summary }}
                    </p>

                @else

                    <p class="text-sm text-slate-400">
                        No weekend summary recorded.
                    </p>

                @endif

            </div>

        </div>


        {{-- Remarks --}}
        @if ($dailyLogbook->remarks)

            <div class="mt-6">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Remarks
                </p>

                <div class="mt-3 rounded-xl bg-slate-50 border border-slate-100 p-5">

                    <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                        {{ $dailyLogbook->remarks }}
                    </p>

                </div>

            </div>

        @endif

    </div>


    {{-- Student & Company --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">


        {{-- Student --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

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
                            d="M16 19v-1.5A3.5 3.5 0 0012.5 14h-5A3.5 3.5 0 004 17.5V19M10 10a3 3 0 100-6 3 3 0 000 6zM16 7a3 3 0 110 6"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Student
                    </h3>

                    <p class="text-sm text-slate-500">
                        Student associated with this logbook.
                    </p>

                </div>

            </div>


            <div class="space-y-4">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Student No.
                    </p>

                    <p class="mt-1 font-bold text-blue-600">
                        {{ $dailyLogbook->placement->student->student_no }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $dailyLogbook->placement->student->name }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Company --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

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
                            d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2M9 11h2M9 15h2M15 7h2M15 11h2M15 15h2"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Company
                    </h3>

                    <p class="text-sm text-slate-500">
                        Industry partner for this placement.
                    </p>

                </div>

            </div>


            <div class="space-y-4">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Company Code
                    </p>

                    <p class="mt-1 font-bold text-blue-600">
                        {{ $dailyLogbook->placement->company->code }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Company Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $dailyLogbook->placement->company->name }}
                    </p>

                </div>


                @if ($dailyLogbook->placement->companyContact)

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Contact Person
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $dailyLogbook->placement->companyContact->name }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('daily-logbooks.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Daily Logbooks
        </a>


        <div class="flex flex-col sm:flex-row gap-3">


            {{-- <a
                href="{{ route('placements.show', $dailyLogbook->placement) }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
            >
                View Placement
            </a> --}}

            {{-- STATUS == DRAF --}}
            @if ($dailyLogbook->status === 'Draft')

                <form
                    method="POST"
                    action="{{ route('daily-logbooks.submit', $dailyLogbook) }}"
                    onsubmit="return confirm('Submit this logbook for approval?');"
                >

                    @csrf

                    <button
                        type="submit"
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
                                d="M5 12h14M13 6l6 6-6 6"
                            />

                        </svg>

                        Submit for Approval

                    </button>

                </form>
                 <a
                    href="{{ route('daily-logbooks.edit', $dailyLogbook) }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
                >
                    Edit Logbook
                </a>

            @endif

            @if ($dailyLogbook->status === 'Submitted')
                @role('Industry Mentor')
                    <form
                        method="POST"
                        action="{{ route('daily-logbooks.approve', $dailyLogbook) }}"
                        onsubmit="return confirm('Approve this logbook?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition shadow-sm"
                        >

                            ✓ Approve

                        </button>

                    </form>


                    <form
                        method="POST"
                        action="{{ route('daily-logbooks.reject', $dailyLogbook) }}"
                        onsubmit="return confirm('Reject this logbook?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow-sm"
                        >

                            ✕ Reject

                        </button>

                    </form>
                @endrole

            @endif

            @if ($dailyLogbook->status === 'Rejected')

                <a
                    href="{{ route('daily-logbooks.edit', $dailyLogbook) }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-amber-500 text-white font-semibold hover:bg-amber-600 transition shadow-sm"
                >
                    Edit & Resubmit
                </a>

            @endif

        </div>

    </div>

</x-app-layout>
