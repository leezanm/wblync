<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Student Assessments
        </h3>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">

                <div class="mb-3">
                    <a
                        href="{{ route('admin.student-assessments.index') }}"
                        class="text-sm text-blue-600 hover:text-blue-700"
                    >
                        ← Back to Assessments
                    </a>
                </div>

                <h1 class="text-2xl font-semibold text-slate-900">
                    {{ $assessmentVersion->assessmentTemplate->name }}
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $assessmentVersion->assessmentTemplate->course?->name }}
                    · Version {{ $assessmentVersion->version }}
                </p>

            </div>


            {{-- Student List --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-4">

                    <h2 class="font-semibold text-slate-900">
                        Student Assessments
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Students assessed under this assessment.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Student
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Score
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Percentage
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100 bg-white">

                            @forelse ($studentAssessments as $assessment)

                                <tr class="hover:bg-slate-50">

                                    <td class="px-6 py-4">

                                        <div class="font-medium text-slate-900">
                                            {{ $assessment->student->name }}
                                        </div>

                                        <div class="text-sm text-slate-500">
                                            {{ $assessment->student->student_no }}
                                        </div>

                                    </td>


                                    <td class="px-6 py-4">

                                        @if ($assessment->status === 'Completed')

                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                                Completed
                                            </span>

                                        @else

                                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                                                Draft
                                            </span>

                                        @endif

                                    </td>


                                    <td class="px-6 py-4 text-sm text-slate-700">

                                        @if ($assessment->total_score !== null)

                                            {{ number_format($assessment->total_score, 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td class="px-6 py-4 text-sm text-slate-700">

                                        @if ($assessment->percentage !== null)

                                            {{ number_format($assessment->percentage, 2) }}%

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td class="px-6 py-4 text-right">

                                        <a
                                            href="{{ route(
                                                'admin.student-assessments.show',
                                                $assessment
                                            ) }}"
                                            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                                        >
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="px-6 py-12 text-center text-sm text-slate-500"
                                    >
                                        No students found for this assessment.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                @if ($studentAssessments->hasPages())

                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $studentAssessments->links() }}
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
