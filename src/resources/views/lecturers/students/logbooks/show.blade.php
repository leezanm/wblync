<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                {{-- <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    {{ $student->name }}
                </p> --}}

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    Weekly Logbook
                </h2>



            </div>




        </div>

    </x-slot>
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

            <div>

                {{-- <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    {{ $student->name }}
                </p> --}}

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    Weekly Logbook
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    View submitted daily activities.
                </p>

            </div>


            <a
                href="{{ route(
                    'lecturer.students.logbooks.index',
                    $student
                ) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Logbooks

            </a>

        </div>

    {{-- Student / Week Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Student --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Student
                </p>

                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $student->name }}
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $student->student_no ?? '-' }}
                </p>

            </div>


            {{-- Company --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Company
                </p>

                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $weeklyLogbookSubmission->placement?->company?->name ?? '-' }}
                </p>

            </div>


            {{-- Week --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Week
                </p>

                <p class="text-lg font-bold text-slate-800 mt-1">

                    {{ $weeklyLogbookSubmission->week_start_date?->format('d M Y') ?? '-' }}

                    <span class="text-slate-400 font-normal">
                        -
                    </span>

                    {{ $weeklyLogbookSubmission->week_end_date?->format('d M Y') ?? '-' }}

                </p>

            </div>


            {{-- Status --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Industry Approval
                </p>

                <div class="mt-2">

                    @if ($weeklyLogbookSubmission->status === 'Submitted')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                            Pending Approval

                        </span>

                    @elseif ($weeklyLogbookSubmission->status === 'Approved')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            Approved

                        </span>

                    @elseif ($weeklyLogbookSubmission->status === 'Rejected')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Rejected

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- Read Only Notice --}}
    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 px-5 py-4">

        <div class="flex items-start gap-3">

            <svg
                class="w-5 h-5 text-blue-600 mt-0.5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M13 16h-1v-4h-1m1-4h.01"
                />

                <circle
                    cx="12"
                    cy="12"
                    r="9"
                    stroke-width="1.8"
                />
            </svg>

            <div>

                <p class="text-sm font-semibold text-blue-800">
                    Read-only view
                </p>

                <p class="text-sm text-blue-700 mt-1">
                    This logbook can be viewed for monitoring purposes.
                    Approval or rejection is handled by the Industry Supervisor.
                </p>

            </div>

        </div>

    </div>


    {{-- Daily Activities --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                Weekly Activities
            </p>

            <h3 class="text-xl font-bold text-slate-800 mt-1">
                Daily Logbook
            </h3>

        </div>


        <div class="divide-y divide-slate-100">

            @forelse ($weeklyLogbookSubmission->dailyLogbooks as $logbook)

                <div class="p-6">

                    <div class="flex flex-col lg:flex-row gap-6">

                        {{-- Date --}}
                        <div class="lg:w-36 shrink-0">

                            <p class="font-bold text-slate-800">
                                {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $logbook->log_date?->format('l') ?? '-' }}
                            </p>

                        </div>


                        {{-- Work Status --}}
                        <div class="lg:w-40 shrink-0">

                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold mb-2">
                                Status
                            </p>

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

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                                        Public Holiday
                                    </span>

                                    @break

                                @case('Leave')

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                        Leave
                                    </span>

                                    @break

                                @case('Medical Leave')

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        Medical Leave
                                    </span>

                                    @break

                                @default

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                        {{ $logbook->work_status ?? 'Not Set' }}
                                    </span>

                            @endswitch

                        </div>


                        {{-- Content --}}
                        <div class="flex-1">

                            @if ($logbook->activity)

                                <div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        Activity
                                    </p>

                                    <p class="text-sm text-slate-600 mt-1 whitespace-pre-line">
                                        {{ $logbook->activity }}
                                    </p>

                                </div>

                            @endif


                            @if ($logbook->learning_outcome)

                                <div class="mt-4">

                                    <p class="text-sm font-semibold text-slate-700">
                                        Learning Outcome
                                    </p>

                                    <p class="text-sm text-slate-600 mt-1 whitespace-pre-line">
                                        {{ $logbook->learning_outcome }}
                                    </p>

                                </div>

                            @endif


                            @if ($logbook->remarks)

                                <div class="mt-4">

                                    <p class="text-sm font-semibold text-slate-700">
                                        Remarks
                                    </p>

                                    <p class="text-sm text-slate-600 mt-1 whitespace-pre-line">
                                        {{ $logbook->remarks }}
                                    </p>

                                </div>

                            @endif

                        </div>


                        {{-- Hours --}}
                        <div class="lg:w-24 shrink-0 lg:text-right">

                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                Hours
                            </p>

                            <p class="text-lg font-bold text-slate-800 mt-1">

                                {{ $logbook->working_hours ?? '-' }}

                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-12 text-center">

                    <p class="text-sm text-slate-500">
                        No daily records found for this submission.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- Rejection Remarks --}}
    @if (
        $weeklyLogbookSubmission->status === 'Rejected'
        && $weeklyLogbookSubmission->remarks
    )

        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-6">

            <p class="text-xs uppercase tracking-wide text-red-500 font-semibold">
                Industry Supervisor Remarks
            </p>

            <h3 class="text-lg font-bold text-red-800 mt-1">
                Reason for Rejection
            </h3>

            <p class="text-sm text-red-700 mt-3 whitespace-pre-line">
                {{ $weeklyLogbookSubmission->remarks }}
            </p>

        </div>

    @endif

</x-app-layout>
