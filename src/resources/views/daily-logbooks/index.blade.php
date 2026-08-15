<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Daily Logbook
                </h2>

            </div>

             {{-- only student can view this button --}}
             @role('student')
            <a
                href="{{ route('daily-logbooks.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
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
                        stroke-width="2"
                        d="M12 5v14M5 12h14"
                    />
                </svg>

                Add Logbook

            </a>
            @endrole


        </div>

    </x-slot>


    {{-- Page Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                List of Daily Logbooks
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage students' daily WBL activities and learning records.
            </p>

        </div>

        @role('student')
        <a
            href="{{ route('daily-logbooks.create') }}"
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
                    stroke-width="2"
                    d="M12 5v14M5 12h14"
                />
            </svg>

            Add Logbook

        </a>
        @endrole
    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
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

    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mt-6 mb-6">

        <form
            method="GET"
            action="{{ route('daily-logbooks.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="md:col-span-4">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search student, student no. or company..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Date From --}}
            <div class="md:col-span-2">
                <input
                    type="date"
                    name="date_from"
                    value="{{ request('date_from') }}"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>


            {{-- Date To --}}
            <div class="md:col-span-2">
                <input
                    type="date"
                    name="date_to"
                    value="{{ request('date_to') }}"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>


            {{-- Status --}}
            <div class="md:col-span-2">

                <select
                    name="status"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="Draft"
                        @selected(request('status') === 'Draft')
                    >
                        Draft
                    </option>

                    <option
                        value="Submitted"
                        @selected(request('status') === 'Submitted')
                    >
                        Submitted
                    </option>

                    <option
                        value="Approved"
                        @selected(request('status') === 'Approved')
                    >
                        Approved
                    </option>

                    <option
                        value="Rejected"
                        @selected(request('status') === 'Rejected')
                    >
                        Rejected
                    </option>

                </select>

            </div>


            {{-- Filter --}}
            <div class="md:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900"
                >
                    Filter
                </button>


                @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))

                    <a
                        href="{{ route('daily-logbooks.index') }}"
                        class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50"
                    >
                        Clear
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- Desktop --}}
    <div class="hidden md:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Student
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Log Date
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Hours
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($logbooks as $logbook)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($logbooks->currentPage() - 1) * $logbooks->perPage() }}

                            </td>


                            {{-- Student --}}
                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $logbook->placement->student->student_no }}
                                </div>

                                <div class="text-sm text-slate-700 mt-1">
                                    {{ $logbook->placement->student->name }}
                                </div>

                            </td>


                            {{-- Company --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $logbook->placement->company->name }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $logbook->placement->company->code }}
                                </div>

                            </td>


                            {{-- Date --}}
                            <td class="px-6 py-4 text-sm text-slate-600">

                                {{ $logbook->log_date->format('d/m/Y') }}

                            </td>


                            {{-- Hours --}}
                            <td class="px-6 py-4 text-sm">

                                @if ($logbook->working_hours !== null)

                                    <span class="font-semibold text-slate-700">
                                        {{ number_format((float) $logbook->working_hours, 2) }}
                                    </span>

                                    <span class="text-slate-400">
                                        hrs
                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">




                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses[$logbook->status] ?? 'bg-slate-100 text-slate-600' }}"
                                >

                                    <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                                    {{ $logbook->status }}

                                </span>

                            </td>


                            {{-- Actions --}}
                           <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('daily-logbooks.show', $logbook) }}"
                                        title="View"
                                        aria-label="View logbook"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 hover:bg-blue-50"
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
                                                d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                                stroke-width="1.8"
                                            />
                                        </svg>
                                    </a>


                                    {{-- Draft --}}
                                    @if ($logbook->status === 'Draft')

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('daily-logbooks.edit', $logbook) }}"
                                            title="Edit"
                                            aria-label="Edit logbook"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 hover:bg-amber-50"
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
                                                    d="M12 20h9"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                                                />
                                            </svg>
                                        </a>


                                        {{-- Submit --}}
                                        <form
                                            method="POST"
                                            action="{{ route('daily-logbooks.submit', $logbook) }}"
                                            onsubmit="return confirm('Submit this logbook for approval?');"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                title="Submit"
                                                aria-label="Submit logbook"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-green-600 hover:bg-green-50"
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

                                            </button>

                                        </form>


                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route('daily-logbooks.destroy', $logbook) }}"
                                            onsubmit="return confirm('Delete this daily logbook?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete"
                                                aria-label="Delete logbook"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50"
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
                                                        d="M4 7h16M10 11v6M14 11v6M6 7v13h12V7M9 7V4h6v3"
                                                    />
                                                </svg>

                                            </button>

                                        </form>

                                    @endif


                                    {{-- Submitted --}}
                                    @if ($logbook->status === 'Submitted')

                                        {{-- Approve --}}
                                        <form
                                            method="POST"
                                            action="{{ route('daily-logbooks.approve', $logbook) }}"
                                            onsubmit="return confirm('Approve this logbook?');"
                                            >

                                            @csrf

                                            <button
                                                type="submit"
                                                title="Approve"
                                                aria-label="Approve logbook"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-green-600 hover:bg-green-50"
                                                >

                                                <svg
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>

                                            </button>

                                        </form>


                                        {{-- Reject --}}
                                        <form
                                            method="POST"
                                            action="{{ route('daily-logbooks.reject', $logbook) }}"
                                            onsubmit="return confirm('Reject this logbook?');"
                                            >

                                            @csrf

                                            <button
                                                type="submit"
                                                title="Reject"
                                                aria-label="Reject logbook"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50"
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
                                                        d="M6 6l12 12M18 6L6 18"
                                                    />
                                                </svg>

                                            </button>

                                        </form>

                                    @endif


                                    {{-- Rejected --}}
                                    @if ($logbook->status === 'Rejected')

                                        <a
                                            href="{{ route('daily-logbooks.edit', $logbook) }}"
                                            title="Edit & Resubmit"
                                            aria-label="Edit and resubmit logbook"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 hover:bg-amber-50"
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
                                                    d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M5 12h6"
                                                />
                                            </svg>

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No daily logbooks found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first daily logbook to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile --}}
    <div class="md:hidden space-y-4">

        @forelse ($logbooks as $logbook)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <div class="text-sm font-bold text-blue-600">
                            {{ $logbook->placement->student->student_no }}
                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $logbook->placement->student->name }}
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            {{ $logbook->placement->company->name }}
                        </p>

                    </div>


                    <span
                        class="shrink-0 px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$logbook->status] ?? 'bg-slate-100 text-slate-600' }}"
                    >
                        {{ $logbook->status }}
                    </span>

                </div>


                <div class="mt-5 space-y-3 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Log Date
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $logbook->log_date->format('d/m/Y') }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Working Hours
                        </span>

                        <span class="font-medium text-slate-700 text-right">

                            {{ $logbook->working_hours !== null
                                ? number_format((float) $logbook->working_hours, 2) . ' hrs'
                                : '-' }}

                        </span>

                    </div>


                    <div>

                        <p class="text-slate-500">
                            Activity
                        </p>

                        <p class="font-medium text-slate-700 mt-1 line-clamp-2">
                            {{ $logbook->activity }}
                        </p>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

    {{-- View --}}
    <a
        href="{{ route('daily-logbooks.show', $logbook) }}"
        title="View"
        aria-label="View logbook"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 bg-blue-50"
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
                d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12z"
            />

            <circle
                cx="12"
                cy="12"
                r="2.5"
                stroke-width="1.8"
            />
        </svg>
    </a>


    @if ($logbook->status === 'Draft')

        {{-- Edit --}}
        <a
            href="{{ route('daily-logbooks.edit', $logbook) }}"
            title="Edit"
            aria-label="Edit logbook"
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 bg-amber-50"
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
                    d="M12 20h9"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                />
            </svg>
        </a>


        {{-- Submit --}}
        <form
            method="POST"
            action="{{ route('daily-logbooks.submit', $logbook) }}"
            onsubmit="return confirm('Submit this logbook for approval?');"
        >

            @csrf

            <button
                type="submit"
                title="Submit"
                aria-label="Submit logbook"
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-green-600 bg-green-50"
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
            </button>

        </form>


        {{-- Delete --}}
        <form
            method="POST"
            action="{{ route('daily-logbooks.destroy', $logbook) }}"
            onsubmit="return confirm('Delete this daily logbook?');"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                title="Delete"
                aria-label="Delete logbook"
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 bg-red-50"
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
                        d="M4 7h16M10 11v6M14 11v6M6 7v13h12V7M9 7V4h6v3"
                    />
                </svg>
            </button>

        </form>

    @elseif ($logbook->status === 'Submitted')

        {{-- Approve --}}
        <form
            method="POST"
            action="{{ route('daily-logbooks.approve', $logbook) }}"
            onsubmit="return confirm('Approve this logbook?');"
        >

            @csrf

            <button
                type="submit"
                title="Approve"
                aria-label="Approve logbook"
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-green-600 bg-green-50"
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>
            </button>

        </form>


        {{-- Reject --}}
        <form
            method="POST"
            action="{{ route('daily-logbooks.reject', $logbook) }}"
            onsubmit="return confirm('Reject this logbook?');"
        >

            @csrf

            <button
                type="submit"
                title="Reject"
                aria-label="Reject logbook"
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 bg-red-50"
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
                        d="M6 6l12 12M18 6L6 18"
                    />
                </svg>
            </button>

        </form>

    @elseif ($logbook->status === 'Rejected')

        {{-- Edit & Resubmit --}}
        <a
            href="{{ route('daily-logbooks.edit', $logbook) }}"
            title="Edit & Resubmit"
            aria-label="Edit and resubmit logbook"
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 bg-amber-50"
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
                    d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M5 12h6"
                />
            </svg>
        </a>

    @endif

</div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No daily logbooks found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add your first daily logbook to get started.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($logbooks->hasPages())

        <div class="mt-6">

            {{ $logbooks->withQueryString()->links() }}

        </div>

    @endif

</x-app-layout>
