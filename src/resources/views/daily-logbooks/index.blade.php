<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    My Daily Logbooks
                </h2>

                {{-- <p class="text-sm text-slate-500 mt-1">
                    Record your daily internship activities and submit your weekly logbook for supervisor approval.
                </p> --}}

            </div>

        </div>

    </x-slot>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error --}}
    @if (session('error'))

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm font-medium text-red-800">
            {{ session('error') }}
        </div>

    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">

            <p class="text-sm font-semibold text-red-800 mb-2">
                Please correct the following errors:
            </p>

            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Placement Information --}}
    @if ($placement)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Current Placement
                    </p>

                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        {{ $placement->company?->name ?? '-' }}
                    </h3>

                    <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-slate-500">

                        <span>
                            {{ $placement->start_date?->format('d M Y') ?? '-' }}
                            -
                            {{ $placement->end_date?->format('d M Y') ?? '-' }}
                        </span>

                        <span class="text-slate-300">
                            |
                        </span>

                        <span>
                            Industry Supervisor:
                            <strong class="text-slate-700">
                                {{ $placement->industrySupervisor?->name ?? '-' }}
                            </strong>
                        </span>

                    </div>

                </div>


                @if ($placement->status === 'Active')

                    <span class="inline-flex items-center gap-2 self-start lg:self-center px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                        Active Placement

                    </span>

                @else

                    <span class="inline-flex self-start lg:self-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">

                        {{ $placement->status }}

                    </span>

                @endif

            </div>

        </div>

    @else

        <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-8 text-center">

            <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-100 flex items-center justify-center">

                <svg
                    class="w-7 h-7 text-amber-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 9v4m0 4h.01M10.29 3.86l-8.02 14A2 2 0 003.99 21h16.02a2 2 0 001.72-3.14l-8.02-14a2 2 0 00-3.42 0z"
                    />
                </svg>

            </div>

            <h3 class="mt-4 text-lg font-bold text-slate-800">
                No Active Placement
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                You do not currently have an active internship placement.
            </p>

        </div>

    @endif


    @if ($placement)

        {{-- Week Header --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="p-6 border-b border-slate-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                            Weekly Logbook
                        </p>

                        <h3 class="text-xl font-bold text-slate-800 mt-1">

                            {{ $weekStart->format('d M Y') }}

                            <span class="text-slate-400 font-normal">
                                -
                            </span>

                            {{ $weekEnd->format('d M Y') }}

                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            All seven days are included in the weekly submission.
                        </p>

                    </div>


                    {{-- Weekly Submission Status --}}
                    <div>

                        @if ($weeklySubmission?->status === 'Submitted')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-100 text-amber-700 text-sm font-semibold">

                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                Pending Approval

                            </span>


                        @elseif ($weeklySubmission?->status === 'Approved')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-green-100 text-green-700 text-sm font-semibold">

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                Approved

                            </span>


                        @elseif ($weeklySubmission?->status === 'Rejected')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-red-100 text-red-700 text-sm font-semibold">

                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                Rejected

                            </span>


                        @else

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold">

                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>

                                Draft

                            </span>

                        @endif

                    </div>

                </div>


                {{-- Rejection Remarks --}}
                @if (
                    $weeklySubmission?->status === 'Rejected'
                    && $weeklySubmission?->remarks
                )

                    <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-red-500">
                            Supervisor Remarks
                        </p>

                        <p class="text-sm text-red-800 mt-1">
                            {{ $weeklySubmission->remarks }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- Daily Logbooks --}}
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Day
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Work Status
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Activity / Remarks
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Hours
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($dailyLogbooks as $logbook)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Date --}}
                                <td class="px-6 py-5 whitespace-nowrap">

                                    <div class="font-semibold text-slate-800">
                                        {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                                    </div>

                                </td>


                                {{-- Day --}}
                                <td class="px-6 py-5 whitespace-nowrap">

                                    <span class="text-sm text-slate-600">
                                        {{ $logbook->log_date?->format('l') ?? '-' }}
                                    </span>

                                </td>


                                {{-- Work Status --}}
                                <td class="px-6 py-5">

                                    @switch($logbook->work_status)

                                        @case('Working')

                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                                Working

                                            </span>

                                            @break


                                        @case('Off Day')

                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">

                                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>

                                                Off Day

                                            </span>

                                            @break


                                        @case('Public Holiday')

                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">

                                                Public Holiday

                                            </span>

                                            @break


                                        @case('Leave')

                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">

                                                Leave

                                            </span>

                                            @break


                                        @case('Medical Leave')

                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                                                Medical Leave

                                            </span>

                                            @break


                                        @default

                                            <span class="inline-flex px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">

                                                {{ $logbook->work_status ?? 'Not Set' }}

                                            </span>

                                    @endswitch

                                </td>


                                {{-- Activity --}}
                                <td class="px-6 py-5 max-w-md">

                                    @if ($logbook->activity)

                                        <p class="text-sm text-slate-700 line-clamp-2">
                                            {{ $logbook->activity }}
                                        </p>

                                    @elseif ($logbook->remarks)

                                        <p class="text-sm text-slate-500 line-clamp-2">
                                            {{ $logbook->remarks }}
                                        </p>

                                    @else

                                        <span class="text-sm text-slate-400">
                                            No entry
                                        </span>

                                    @endif

                                </td>


                                {{-- Hours --}}
                                <td class="px-6 py-5 whitespace-nowrap">

                                    @if ($logbook->working_hours !== null)

                                        <span class="text-sm font-medium text-slate-700">

                                            {{ $logbook->working_hours }}

                                            {{ $logbook->working_hours == 1 ? 'hour' : 'hours' }}

                                        </span>

                                    @else

                                        <span class="text-sm text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- Action --}}
                                <td class="px-6 py-5 whitespace-nowrap">

                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route('daily-logbooks.show', $logbook) }}"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200"
                                        >
                                            View
                                        </a>


                                        @if (
                                            !$weeklySubmission
                                            || $weeklySubmission->status === 'Rejected'
                                        )

                                            <a
                                                href="{{ route('daily-logbooks.edit', $logbook) }}"
                                                class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-blue-50 text-blue-600 text-sm font-medium hover:bg-blue-100"
                                            >
                                                Edit
                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center">

                                        <svg
                                            class="w-7 h-7 text-slate-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-700">
                                        No daily logbooks
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        No logbook entries have been recorded for this week.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Weekly Actions --}}
            <div class="p-6 border-t border-slate-100 bg-slate-50">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        @if ($weeklySubmission?->status === 'Submitted')

                            <p class="text-sm font-medium text-amber-700">
                                This week's logbook has been submitted for supervisor approval.
                            </p>

                            @if ($weeklySubmission->submitted_at)

                                <p class="text-xs text-slate-500 mt-1">
                                    Submitted on
                                    {{ $weeklySubmission->submitted_at->format('d M Y, h:i A') }}
                                </p>

                            @endif


                        @elseif ($weeklySubmission?->status === 'Approved')

                            <p class="text-sm font-medium text-green-700">
                                This week's logbook has been approved by your Industry Supervisor.
                            </p>


                        @elseif ($weeklySubmission?->status === 'Rejected')

                            <p class="text-sm font-medium text-red-700">
                                Your weekly logbook was rejected. Please update the required entries and resubmit.
                            </p>


                        @else

                            <p class="text-sm font-medium text-slate-700">
                                Review your entries before submitting this week.
                            </p>

                            <p class="text-xs text-slate-500 mt-1">
                                All seven days are included, including off days, leave and medical leave.

                            </p>

                        @endif

                    </div>


                    {{-- Submit / Resubmit --}}
                    @if (
                        !$weeklySubmission
                        || $weeklySubmission->status === 'Rejected'
                    )

                        <form
                            method="POST"
                            action="{{ route('daily-logbooks.submit-week') }}"
                            onsubmit="return confirm('Submit this week\\'s logbook for Industry Supervisor approval?');"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="date"
                                value="{{ $weekStart->toDateString() }}"
                            >

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
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                @if ($weeklySubmission?->status === 'Rejected')
                                    Resubmit This Week
                                @else
                                    Submit This Week
                                @endif

                            </button>

                        </form>

                    @elseif ($weeklySubmission?->status === 'Submitted')

                        <span class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-amber-100 text-amber-700 font-semibold">

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
                                    d="M12 8v4l3 2"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                    stroke-width="2"
                                />
                            </svg>

                            Pending Approval

                        </span>

                    @elseif ($weeklySubmission?->status === 'Approved')

                        <span class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-100 text-green-700 font-semibold">

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
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            Week Approved

                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- Add Logbook --}}
        @can('create daily logbooks')

            @if (
                !$weeklySubmission
                || $weeklySubmission->status === 'Rejected'
            )

                <div class="mt-6 flex justify-end">

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

                </div>

            @endif

        @endcan

    @endif

</x-app-layout>
