<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Student Assessment
        </h3>
    </x-slot>
    <div class="mx-auto max-w-7xl p-6">

        {{-- Header --}}

        <div class="mb-6 flex items-start justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    {{ $studentAssessment->assessmentVersion->assessmentTemplate->code }}
                </p>

                <h1 class="mt-1 text-2xl font-semibold">
                    {{ $studentAssessment->assessmentVersion->assessmentTemplate->name }}
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Version {{ $studentAssessment->assessmentVersion->version }}
                </p>

            </div>

            <div class="flex gap-2">

                <a href="{{ route('industry-supervisor.assessments.index') }}"
                    class="rounded-md border border-gray-400 px-4 py-2 text-sm">
                    Back
                </a>

            </div>

        </div>


        {{-- Success Message --}}

        @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Student Information --}}

        <div class="mb-6 rounded-lg border bg-white p-6">

            <h2 class="mb-4 text-lg font-semibold">
                Student Information
            </h2>

            <div class="grid gap-6 md:grid-cols-3">

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Student
                    </p>

                    <p class="mt-1 font-medium">
                        {{ $studentAssessment->student->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Student No.
                    </p>

                    <p class="mt-1 font-medium">
                        {{ $studentAssessment->student->student_no }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Assessment Date
                    </p>

                    <p class="mt-1 font-medium">
                        {{ $studentAssessment->assessed_at?->format('d/m/Y') ?? '-' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Assessment Summary --}}

        <div class="mb-6 rounded-lg border bg-white p-6">

            <h2 class="mb-4 text-lg font-semibold">
                Assessment Summary
            </h2>

            <div class="grid gap-6 md:grid-cols-4">

                <div>

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Assessor
                    </p>

                    <p class="mt-1 font-medium">
                        {{ $studentAssessment->assessor_type }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Status
                    </p>

                    <span class="mt-1 inline-block rounded-full bg-green-100 text-green-800 px-3 py-1 text-sm">
                        {{ $studentAssessment->status }}
                    </span>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Total Score
                    </p>

                    <p class="mt-1 text-lg font-semibold">
                        {{ number_format((float) $studentAssessment->total_score, 2) }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Percentage
                    </p>

                    <p class="mt-1 text-lg font-semibold">
                        {{ number_format((float) $studentAssessment->percentage, 2) }}%
                    </p>

                </div>

            </div>

        </div>


        {{-- Instructions --}}

        @if ($studentAssessment->assessmentVersion->instructions)
            <div class="mb-6 rounded-lg border bg-white p-6">

                <h2 class="mb-3 text-lg font-semibold">
                    Instructions
                </h2>

                <p class="whitespace-pre-line text-sm text-gray-600">
                    {{ $studentAssessment->assessmentVersion->instructions }}
                </p>

            </div>
        @endif




        {{-- Rubric --}}

        <form method="POST" action="{{ route('student-assessments.scores.save', $studentAssessment) }}">
            @csrf

            <div class="space-y-6">

                @foreach ($studentAssessment->assessmentVersion->sections as $section)
                    <div class="overflow-hidden rounded-lg border bg-white">

                        <div class="border-b bg-gray-50 px-6 py-4">

                            <h2 class="font-semibold">
                                {{ $section->name }}
                            </h2>

                            @if ($section->description)
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $section->description }}
                                </p>
                            @endif

                        </div>


                        <div class="divide-y">

                            @foreach ($section->criteria as $criterion)
                                @php
                                    $existingScore = $studentAssessment->scores->firstWhere(
                                        'assessment_criterion_id',
                                        $criterion->id,
                                    );
                                @endphp

                                <div class="p-6">

                                    <div class="mb-4 flex items-start justify-between">

                                        <div>

                                            <h3 class="font-medium">
                                                {{ $criterion->name }}
                                            </h3>

                                            @if ($criterion->description)
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $criterion->description }}
                                                </p>
                                            @endif

                                        </div>

                                        <div class="text-right">

                                            <p class="text-xs text-gray-500">
                                                Maximum
                                            </p>

                                            <p class="font-semibold">
                                                {{ number_format((float) $criterion->max_score, 0) }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- Ratings --}}

                                    <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-4">

                                        @foreach ($criterion->ratingLevels as $rating)
                                            <label class="cursor-pointer rounded-lg border p-4 hover:bg-gray-50">

                                                <div class="flex items-start gap-3">

                                                    <input type="radio"
                                                        name="scores[{{ $criterion->id }}][rating_level_id]"
                                                        value="{{ $rating->id }}" class="mt-1"
                                                        @checked($existingScore?->rating_level_id == $rating->id) required>

                                                    <div>

                                                        <div class="flex items-center gap-2">

                                                            <span class="font-medium">
                                                                {{ $rating->label }}
                                                            </span>

                                                            <span
                                                                class="rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold">
                                                                {{ number_format((float) $rating->score, 0) }}
                                                            </span>

                                                        </div>

                                                        @if ($rating->description)
                                                            <p class="mt-2 text-sm text-gray-500">
                                                                {{ $rating->description }}
                                                            </p>
                                                        @endif

                                                    </div>

                                                </div>

                                            </label>
                                        @endforeach

                                    </div>


                                    {{-- Hidden Criterion ID --}}

                                    <input type="hidden" name="scores[{{ $criterion->id }}][assessment_criterion_id]"
                                        value="{{ $criterion->id }}">


                                    {{-- Remark --}}

                                    <div class="mt-4">

                                        <label class="block text-sm font-medium">
                                            Remark
                                        </label>

                                        <textarea name="scores[{{ $criterion->id }}][remark]" rows="2"
                                            class="mt-1 block w-full rounded-md border-gray-300" placeholder="Optional remark...">{{ old("scores.{$criterion->id}.remark", $existingScore?->remark) }}</textarea>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </div>
            {{-- Remarks --}}

            @if ($studentAssessment->remarks)
                <div class="mt-6 rounded-lg border bg-white p-6">

                    <h2 class="mb-3 text-lg font-semibold">
                        Remarks
                    </h2>

                    <p class="whitespace-pre-line text-sm text-gray-600">
                        {{ $studentAssessment->remarks }}
                    </p>

                </div>
            @endif
            {{-- Action Buttons --}}

            <div class="mt-6 flex justify-end gap-3">

                {{-- Save --}}
                @if ($studentAssessment->status === 'Draft')
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                        Save Assessment
                    </button>
                @endif

                {{-- Complete --}}
                @if ($studentAssessment->status === 'Draft')
                    <button type="submit" form="complete-assessment-form"
                        class="rounded-md bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700">
                        Complete Assessment
                    </button>
                @endif

            </div>

        </form>


        {{-- Complete Assessment Form --}}

        <form id="complete-assessment-form" action="{{ route('student-assessments.complete', $studentAssessment) }}"
            method="POST">
            @csrf
        </form>

    </div>

</x-app-layout>
