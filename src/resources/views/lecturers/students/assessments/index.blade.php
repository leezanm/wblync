<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Student Assessments
        </h3>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="mb-3">
                    <a
                        href="{{ route('lecturer.students.index') }}"
                        class="text-sm text-blue-600 hover:text-blue-700"
                    >
                        ← Back to Assigned Students
                    </a>
                </div>

                <h1 class="text-2xl font-semibold text-slate-900">
                    {{ $student->name }}
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $student->student_no }}
                </p>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h2 class="font-semibold text-slate-900">
                        Assessments
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        View and print student assessment forms under your supervision.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Assessment
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
                                            {{ $assessment->assessmentVersion->assessmentTemplate->name }}
                                        </div>
                                        <div class="text-sm text-slate-500">
                                            {{ $assessment->assessmentVersion->assessmentTemplate->course?->name }}
                                            · Version {{ $assessment->assessmentVersion->version }}
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
                                        <div class="inline-flex gap-2">
                                            <a
                                                href="{{ route('lecturer.student-assessments.show', $assessment) }}"
                                                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('lecturer.student-assessments.print', $assessment) }}"
                                                target="_blank"
                                                class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                                            >
                                                Print
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-6 py-12 text-center text-sm text-slate-500"
                                    >
                                        No assessments found for this student.
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
