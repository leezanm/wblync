<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    My Students
                </p>

                {{-- <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $student->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Weekly submitted logbooks
                </p> --}}

            </div>


            {{-- <a
                href="{{ route('lecturer.students.index') }}"
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

                Back to My Students

            </a> --}}

        </div>

    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

        <div>


            <h3 class="text-2xl font-bold text-slate-800 mt-1">
                My Student Logbooks
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Weekly submitted logbooks
            </p>

        </div>

        <a
            href="{{ route('lecturer.students.index') }}"
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

            Back to My Students

        </a>

    </div>

    {{-- Student Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <div class="flex flex-col md:flex-row md:items-center gap-5">

            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">

                <svg
                    class="w-7 h-7 text-blue-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                    />

                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                        stroke-width="1.8"
                    />
                </svg>

            </div>


            <div>

                <h3 class="text-xl font-bold text-slate-800">
                    {{ $student->name }}
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Student No:
                    {{ $student->student_no ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Weekly Logbooks --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="p-6 border-b border-slate-100">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Logbook Records
                    </p>

                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        Weekly Logbooks
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Weekly logbooks submitted by the student.
                    </p>

                </div>


                <div class="px-4 py-2 rounded-xl bg-blue-50 text-blue-700 text-sm font-semibold">

                    {{ $submissions->total() }} Weeks

                </div>

            </div>

        </div>


        {{-- List --}}
        <div class="divide-y divide-slate-100">

            @forelse ($submissions as $submission)

                <div class="p-6 hover:bg-slate-50 transition">

                    <div class="flex flex-col lg:flex-row lg:items-center gap-5">

                        {{-- Week --}}
                        <div class="lg:w-56 shrink-0">

                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                Week
                            </p>

                            <p class="text-lg font-bold text-slate-800 mt-1">

                                {{ $submission->week_start_date?->format('d M Y') ?? '-' }}

                                <span class="text-slate-400 font-normal">
                                    -
                                </span>

                                {{ $submission->week_end_date?->format('d M Y') ?? '-' }}

                            </p>

                        </div>


                        {{-- Daily Records --}}
                        <div class="flex-1">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">

                                    <svg
                                        class="w-5 h-5 text-slate-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M9 5h6M9 9h6M9 13h4M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                        />
                                    </svg>

                                </div>


                                <div>

                                    <p class="font-semibold text-slate-700">

                                        {{ $submission->dailyLogbooks->count() }}

                                        Daily Records

                                    </p>

                                    <p class="text-sm text-slate-500 mt-1">

                                        Submitted
                                        {{ $submission->submitted_at?->format('d M Y, h:i A') ?? '-' }}

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Status --}}
                        <div class="shrink-0">

                            @if ($submission->status === 'Submitted')

                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                    Pending Approval

                                </span>

                            @elseif ($submission->status === 'Approved')

                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                    Approved

                                </span>

                            @elseif ($submission->status === 'Rejected')

                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                    Rejected

                                </span>

                            @endif

                        </div>


                        {{-- View --}}
                        <div class="shrink-0">

                            <a
                                href="{{ route(
                                    'lecturer.students.logbooks.show',
                                    [
                                        'student' => $student,
                                        'weeklyLogbookSubmission' => $submission,
                                    ]
                                ) }}"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27-2.94 9.54-7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z"
                                    />
                                </svg>

                                View

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="py-16 text-center px-6">

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
                                d="M9 12h6M9 16h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                            />
                        </svg>

                    </div>


                    <h3 class="mt-4 font-semibold text-slate-700">
                        No submitted logbooks
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        This student has not submitted any weekly logbooks yet.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if ($submissions->hasPages())

            <div class="p-6 border-t border-slate-100">

                {{ $submissions->links() }}

            </div>

        @endif

    </div>

</x-app-layout>
