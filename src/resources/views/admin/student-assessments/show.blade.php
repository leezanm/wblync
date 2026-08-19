<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Student Assessment
        </h3>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <div class="mb-6">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-blue-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>

                    Back to Students
                </a>
            </div>


            {{-- Header --}}
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

                    <div>

                        <p class="text-sm font-medium text-blue-600">
                            Student Assessment
                        </p>

                        <h1 class="mt-1 text-2xl font-semibold text-slate-900">
                            {{ $studentAssessment->student->name }}
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $studentAssessment->student->student_no }}
                        </p>

                    </div>


                    {{-- Status --}}
                    <div>

                        @if ($studentAssessment->status === 'Completed')
                            <span
                                class="inline-flex items-center rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                                Completed
                            </span>
                        @else
                            <span
                                class="inline-flex items-center rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-700">
                                Draft
                            </span>
                        @endif

                    </div>

                </div>

            </div>


            {{-- Assessment Information --}}
            <div class="mb-6 grid gap-6 md:grid-cols-2">

                {{-- Student --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-4 text-base font-semibold text-slate-900">
                        Student Information
                    </h2>

                    <dl class="space-y-3">

                        <div class="flex justify-between gap-4">
                            <dt class="text-sm text-slate-500">
                                Name
                            </dt>

                            <dd class="text-right text-sm font-medium text-slate-900">
                                {{ $studentAssessment->student->name }}
                            </dd>
                        </div>

                        <div class="flex justify-between gap-4">
                            <dt class="text-sm text-slate-500">
                                Student No.
                            </dt>

                            <dd class="text-right text-sm font-medium text-slate-900">
                                {{ $studentAssessment->student->student_no }}
                            </dd>
                        </div>

                        @if ($studentAssessment->student->email)
                            <div class="flex justify-between gap-4">
                                <dt class="text-sm text-slate-500">
                                    Email
                                </dt>

                                <dd class="text-right text-sm text-slate-900">
                                    {{ $studentAssessment->student->email }}
                                </dd>
                            </div>
                        @endif

                    </dl>

                </div>


                {{-- Assessment --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-4 text-base font-semibold text-slate-900">
                        Assessment Information
                    </h2>

                    <dl class="space-y-3">

                        <div class="flex justify-between gap-4">
                            <dt class="text-sm text-slate-500">
                                Assessment
                            </dt>

                            <dd class="text-right text-sm font-medium text-slate-900">
                                {{ $studentAssessment->assessmentVersion->assessmentTemplate->name }}
                            </dd>
                        </div>

                        @if ($studentAssessment->assessmentVersion->assessmentTemplate->course)
                            <div class="flex justify-between gap-4">
                                <dt class="text-sm text-slate-500">
                                    Course
                                </dt>

                                <dd class="text-right text-sm text-slate-900">
                                    {{ $studentAssessment->assessmentVersion->assessmentTemplate->course->name }}
                                </dd>
                            </div>
                        @endif

                        <div class="flex justify-between gap-4">
                            <dt class="text-sm text-slate-500">
                                Version
                            </dt>

                            <dd class="text-right text-sm font-medium text-slate-900">
                                Version {{ $studentAssessment->assessmentVersion->version }}
                            </dd>
                        </div>

                        @if ($studentAssessment->assessed_at)
                            <div class="flex justify-between gap-4">
                                <dt class="text-sm text-slate-500">
                                    Assessed At
                                </dt>

                                <dd class="text-right text-sm text-slate-900">
                                    {{ \Carbon\Carbon::parse($studentAssessment->assessed_at)->format('d M Y, h:i A') }}
                                </dd>
                            </div>
                        @endif

                    </dl>

                </div>

            </div>


            {{-- Overall Result --}}
            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Assessment Result
                </h2>

                <div class="grid gap-4 sm:grid-cols-3">

                    <div class="rounded-xl bg-slate-50 p-5">

                        <p class="text-sm text-slate-500">
                            Total Score
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">

                            @if ($studentAssessment->total_score !== null)
                                {{ number_format($studentAssessment->total_score, 2) }}
                            @else
                                —
                            @endif

                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-5">

                        <p class="text-sm text-slate-500">
                            Percentage
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">

                            @if ($studentAssessment->percentage !== null)
                                {{ number_format($studentAssessment->percentage, 2) }}%
                            @else
                                —
                            @endif

                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-5">

                        <p class="text-sm text-slate-500">
                            Status
                        </p>

                        <p class="mt-2 text-lg font-bold">

                            @if ($studentAssessment->status === 'Completed')
                                <span class="text-green-600">
                                    Completed
                                </span>
                            @else
                                <span class="text-amber-600">
                                    Draft
                                </span>
                            @endif

                        </p>

                    </div>

                </div>


                @if ($studentAssessment->remarks)
                    <div class="mt-5 rounded-xl bg-slate-50 p-5">

                        <p class="mb-2 text-sm font-medium text-slate-700">
                            Overall Remarks
                        </p>

                        <p class="whitespace-pre-line text-sm leading-6 text-slate-600">
                            {{ $studentAssessment->remarks }}
                        </p>

                    </div>
                @endif

            </div>


            {{-- Rubric --}}
            <div class="space-y-6">

                @foreach ($studentAssessment->assessmentVersion->sections as $section)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        {{-- Section --}}
                        <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                            <h2 class="text-lg font-semibold text-slate-900">
                                {{ $section->name }}
                            </h2>

                            @if ($section->description)
                                <p class="mt-1 text-sm leading-6 text-slate-500">
                                    {{ $section->description }}
                                </p>
                            @endif

                        </div>


                        {{-- Criteria --}}
                        <div class="divide-y divide-slate-100">

                            @foreach ($section->criteria as $criterion)
                                @php

                                    $score = $studentAssessment->scores->firstWhere(
                                        'assessment_criterion_id',
                                        $criterion->id,
                                    );

                                    $rating = $criterion->ratingLevels->firstWhere(
                                        'id',
                                        optional($score)->rating_level_id,
                                    );

                                @endphp


                                <div class="p-6">

                                    {{-- Criterion Header --}}
                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                        <div>

                                            <h3 class="font-semibold text-slate-900">
                                                {{ $criterion->name }}
                                            </h3>

                                            @if ($criterion->description)
                                                <p class="mt-1 text-sm leading-6 text-slate-500">
                                                    {{ $criterion->description }}
                                                </p>
                                            @endif

                                        </div>


                                        <div class="shrink-0 rounded-lg bg-slate-100 px-3 py-2 text-sm">

                                            <span class="font-semibold text-slate-900">
                                                {{ optional($score)->score ?? '—' }}
                                            </span>

                                            <span class="text-slate-500">
                                                / {{ number_format($criterion->max_score, 2) }}
                                            </span>

                                        </div>

                                    </div>


                                    {{-- Selected Rating --}}
                                    <div class="mt-5">

                                        <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                            Rating
                                        </p>

                                        @if ($rating)
                                            <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">

                                                <div
                                                    class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                                    <div>

                                                        <p class="font-semibold text-slate-900">
                                                            {{ $rating->label }}
                                                        </p>

                                                        @if ($rating->description)
                                                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                                                {{ $rating->description }}
                                                            </p>
                                                        @endif

                                                    </div>

                                                    <span class="shrink-0 text-lg font-bold text-blue-600">
                                                        {{ number_format($rating->score, 2) }}
                                                    </span>

                                                </div>

                                            </div>
                                        @else
                                            <div
                                                class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4">

                                                <p class="text-sm text-slate-500">
                                                    No rating has been selected.
                                                </p>

                                            </div>
                                        @endif

                                    </div>


                                    {{-- Assessor Remark --}}
                                    @if ($score?->remark)
                                        <div class="mt-4">

                                            <p
                                                class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                                Assessor Remark
                                            </p>

                                            <div class="rounded-xl bg-slate-50 p-4">

                                                <p class="whitespace-pre-line text-sm leading-6 text-slate-600">
                                                    {{ $score->remark }}
                                                </p>

                                            </div>

                                        </div>
                                    @endif

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </div>


            {{-- Bottom Navigation --}}
            <div class="mt-8 flex justify-start">

                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-white px-5 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    ← Back to Students
                </a>
                <a href="{{ route('admin.student-assessments.print', $studentAssessment) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-medium text-white hover:bg-blue-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M6 9V3h12v6M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 14h12v7H6z" />
                    </svg>
                    Print Assessment Form
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
