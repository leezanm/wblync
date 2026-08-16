<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                    Lecturer Monitoring
                </p>

                {{-- <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    Student Monitoring
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Review and manage monitoring records for students under your supervision.
                </p> --}}

            </div>


            {{-- <div class="inline-flex items-center gap-3 self-start rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3 text-blue-700 shadow-sm">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white shadow-sm">

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h3m-6 4h12a2 2 0 002-2V6a2 2 0 00-2-2H9.414a2 2 0 00-1.414.586L4.586 8A2 2 0 004 9.414V18a2 2 0 002 2z"
                        />
                    </svg>

                </div>


                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-500">
                        Total Students
                    </p>
                    <p class="text-lg font-bold text-blue-700">
                        {{ $students->count() }}
                    </p>
                </div>

            </div> --}}

        </div>

    </x-slot>

   <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                    Lecturer Monitoring
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    Student Monitoring
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Review and manage monitoring records for students under your supervision.
                </p>

            </div>


            <div class="inline-flex items-center gap-3 self-start rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3 text-blue-700 shadow-sm">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white shadow-sm">

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h3m-6 4h12a2 2 0 002-2V6a2 2 0 00-2-2H9.414a2 2 0 00-1.414.586L4.586 8A2 2 0 004 9.414V18a2 2 0 002 2z"
                        />
                    </svg>

                </div>


                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-500">
                        Total Students
                    </p>
                    <p class="text-lg font-bold text-blue-700">
                        {{ $students->count() }}
                    </p>
                </div>

            </div>

        </div>

    @if (session('success'))

        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700 shadow-sm">
            {{ session('success') }}
        </div>

    @endif


    <div class="mb-6 rounded-3xl border border-blue-200 bg-gradient-to-br from-blue-700 via-sky-700 to-cyan-600 p-6 text-white shadow-sm">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

            <div class="max-w-2xl">

                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-cyan-100">
                    Monitoring Overview
                </p>

                <h3 class="mt-2 text-2xl font-bold text-white">
                    Keep student supervision records organised and easy to access
                </h3>

                <p class="mt-3 text-sm leading-6 text-blue-50">
                    Choose a student below to review existing monitoring records or continue the lecturer monitoring workflow for internship follow-up.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                <div class="rounded-2xl border border-white/30 bg-white/20 px-4 py-4 backdrop-blur-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-cyan-50">
                        Active List
                    </p>
                    <p class="mt-2 text-2xl font-bold text-white">
                        {{ $students->count() }}
                    </p>
                    <p class="mt-1 text-xs text-blue-50">
                        Students ready for lecturer monitoring review
                    </p>
                </div>

                <div class="rounded-2xl border border-white/30 bg-white/20 px-4 py-4 backdrop-blur-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-cyan-50">
                        Next Step
                    </p>
                    <p class="mt-2 text-sm font-semibold text-white">
                        Open a student profile
                    </p>
                    <p class="mt-1 text-xs text-blue-50">
                        View monitoring history and continue with the required visit number
                    </p>
                </div>

            </div>

        </div>

    </div>


    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">

        <div class="border-b border-slate-100 bg-blue-100 px-6 py-5">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h3 class="mt-1 text-xl font-bold text-slate-800">
                         Observer Report
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">

                    </p>
                </div>

                <div class="inline-flex items-center rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">
                    {{ $students->count() }} Students
                </div>

            </div>

        </div>


        <div class="p-6">

            @forelse ($students as $student)

                <div class="mb-5 last:mb-0 rounded-2xl border border-slate-00 bg-slate-50/70 p-5 transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-white hover:shadow-md">

                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                        <div class="flex items-start gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-100">

                                <svg
                                    class="h-7 w-7 text-blue-600"
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

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M22 21v-2a4 4 0 00-3-3.87"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>

                            </div>


                            <div class="min-w-0">

                                <h4 class="text-lg font-bold text-slate-800">
                                    {{ $student->name }}
                                </h4>

                                <p class="mt-1 text-sm text-slate-500">
                                    Student No: {{ $student->student_no ?? '-' }}
                                </p>

                                <div class="mt-3 flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                        Monitoring Candidate
                                    </span>

                                    @if ($student->email)
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                            {{ $student->email }}
                                        </span>
                                    @endif
                                </div>

                            </div>

                        </div>


                        <div class="grid gap-3 sm:grid-cols-2 lg:min-w-[340px]">

                            <div class="rounded-2xl bg-white px-4 py-3 ring-1 ring-slate-200">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Phone
                                </p>
                                <p class="mt-1 text-sm font-medium text-slate-700">
                                    {{ $student->phone ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white px-4 py-3 ring-1 ring-slate-200">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Logbook Access
                                </p>
                                <p class="mt-1 text-sm font-medium text-slate-700">
                                    Ready for monitoring
                                </p>
                            </div>

                        </div>


                        <div class="shrink-0">

                            <a
                                href="{{ route('lecturer.monitoring.student', $student) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >

                                View Monitoring

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">

                        <svg
                            class="h-8 w-8 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m12 0H7m8-13a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>

                    </div>

                    <p class="mt-5 text-lg font-semibold text-slate-700">
                        No students found
                    </p>

                    <p class="mt-2 text-sm text-slate-500">
                        No students are currently assigned to you for monitoring.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
