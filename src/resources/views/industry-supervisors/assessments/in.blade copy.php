<x-app-layout>

    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-blue-600">
                    Assessment
                </p>

                <h1 class="mt-1 text-2xl font-semibold text-slate-900">
                    My Assessments
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Manage and complete assessments for your students.
                </p>

            </div>


            {{-- Assessment List --}}
            <div class="space-y-4">

                @forelse ($studentAssessments as $assessment)

                    <div
                        class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
                    >

                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                            {{-- Assessment Info --}}
                            <div>

                                <div class="flex flex-wrap items-center gap-2">

                                    <h2 class="text-lg font-semibold text-slate-900">
                                        {{ $assessment->assessmentVersion->assessmentTemplate->name }}
                                    </h2>

                                    @if ($assessment->status === 'Completed')

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Completed
                                        </span>

                                    @else

                                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                            Draft
                                        </span>

                                    @endif

                                </div>


                                <div class="mt-2 space-y-1 text-sm text-slate-500">

                                    <p>
                                        Student:
                                        <span class="font-medium text-slate-700">
                                            {{ $assessment->student->name }}
                                        </span>
                                    </p>

                                    <p>
                                        Student No:
                                        <span class="font-medium text-slate-700">
                                            {{ $assessment->student->student_no }}
                                        </span>
                                    </p>

                                    <p>
                                        Version:
                                        <span class="font-medium text-slate-700">
                                            {{ $assessment->assessmentVersion->version }}
                                        </span>
                                    </p>

                                </div>

                            </div>


                            {{-- Result --}}
                            <div class="flex items-center gap-8">

                                <div>

                                    <p class="text-xs uppercase tracking-wider text-slate-400">
                                        Score
                                    </p>

                                    <p class="mt-1 text-xl font-bold text-slate-900">

                                        {{ $assessment->total_score !== null
                                            ? number_format($assessment->total_score, 2)
                                            : '—'
                                        }}

                                    </p>

                                </div>


                                <div>

                                    <p class="text-xs uppercase tracking-wider text-slate-400">
                                        Percentage
                                    </p>

                                    <p class="mt-1 text-xl font-bold text-slate-900">

                                        {{ $assessment->percentage !== null
                                            ? number_format($assessment->percentage, 2) . '%'
                                            : '—'
                                        }}

                                    </p>

                                </div>

                            </div>


                            {{-- Action --}}
                            <div>

                                <a
                                    href="{{ route(
                                        'student-assessments.show',
                                        $assessment
                                    ) }}"
                                    class="
                                        inline-flex items-center gap-2
                                        rounded-xl
                                        bg-blue-600
                                        px-5
                                        py-3
                                        text-sm
                                        font-medium
                                        text-white
                                        hover:bg-blue-700
                                    "
                                >

                                    @if ($assessment->status === 'Completed')

                                        View Assessment

                                    @else

                                        Continue Assessment

                                    @endif

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

                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">

                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">

                            <svg
                                class="h-6 w-6 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5h6M9 9h6M9 13h4M6 3h9l3 3v15H6V3z"
                                />
                            </svg>

                        </div>

                        <h3 class="text-sm font-semibold text-slate-900">
                            No assessments found
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            You currently have no student assessments assigned to you.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}
            @if ($studentAssessments->hasPages())

                <div class="mt-6">
                    {{ $studentAssessments->links() }}
                </div>

            @endif

        </div>

    </div>

</x-app-layout>
