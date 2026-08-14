<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Assessment Details
                </h2>

            </div>


            <a
                href="{{ route('assessments.edit', $assessment) }}"
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
                        stroke-width="1.8"
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                    />
                </svg>

                Edit Assessment

            </a>

        </div>

    </x-slot>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Assessment Summary --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Assessment
                </p>

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $assessment->placement->student->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $assessment->placement->student->student_no }}
                </p>

            </div>


            @php

                $statusClasses = [
                    'Draft' => 'bg-slate-100 text-slate-600',
                    'Submitted' => 'bg-blue-100 text-blue-700',
                    'Completed' => 'bg-green-100 text-green-700',
                ];

            @endphp


            <span
                class="inline-flex items-center gap-2 self-start sm:self-auto px-4 py-2 rounded-full text-sm font-semibold {{ $statusClasses[$assessment->status] ?? 'bg-slate-100 text-slate-600' }}"
            >

                <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                {{ $assessment->status }}

            </span>

        </div>

    </div>


    {{-- Assessment Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-blue-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M6 3h9l3 3v15H6V3z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 11h6M9 15h6M9 7h3"
                    />

                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Assessment Information
                </h3>

                <p class="text-sm text-slate-500">
                    Assessment result and evaluation details.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Date --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Assessment Date
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $assessment->assessment_date->format('d/m/Y') }}
                </p>

            </div>


            {{-- Score --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Score
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-800">

                    {{ $assessment->score !== null
                        ? number_format((float) $assessment->score, 2)
                        : '-' }}

                </p>

            </div>


            {{-- Grade --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Grade
                </p>

                @if ($assessment->grade)

                    <span class="mt-2 inline-flex items-center justify-center min-w-14 px-4 py-2 rounded-xl bg-blue-50 text-blue-700 text-lg font-bold">
                        {{ $assessment->grade }}
                    </span>

                @else

                    <p class="mt-2 font-semibold text-slate-400">
                        -
                    </p>

                @endif

            </div>


            {{-- Status --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Status
                </p>

                <span
                    class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses[$assessment->status] ?? 'bg-slate-100 text-slate-600' }}"
                >

                    <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                    {{ $assessment->status }}

                </span>

            </div>

        </div>


        {{-- Remarks --}}
        @if ($assessment->remarks)

            <div class="mt-8 pt-6 border-t border-slate-100">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Remarks
                </p>

                <div class="mt-3 rounded-xl bg-slate-50 border border-slate-100 p-5">

                    <p class="text-sm leading-6 text-slate-700 whitespace-pre-line">
                        {{ $assessment->remarks }}
                    </p>

                </div>

            </div>

        @endif

    </div>


    {{-- Student & Placement --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">


        {{-- Student --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">

                    <svg
                        class="w-5 h-5 text-indigo-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M16 19v-1.5A3.5 3.5 0 0012.5 14h-5A3.5 3.5 0 004 17.5V19M10 10a3 3 0 100-6 3 3 0 000 6zM16 7a3 3 0 110 6"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Student
                    </h3>

                    <p class="text-sm text-slate-500">
                        Student associated with this assessment.
                    </p>

                </div>

            </div>


            <div class="space-y-4">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Student No.
                    </p>

                    <p class="mt-1 font-bold text-blue-600">
                        {{ $assessment->placement->student->student_no }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $assessment->placement->student->name }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Company --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">

                    <svg
                        class="w-5 h-5 text-amber-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2M9 11h2M9 15h2M15 7h2M15 11h2M15 15h2"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Company
                    </h3>

                    <p class="text-sm text-slate-500">
                        Industry partner for this placement.
                    </p>

                </div>

            </div>


            <div class="space-y-4">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Company Code
                    </p>

                    <p class="mt-1 font-bold text-blue-600">
                        {{ $assessment->placement->company->code }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Company Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $assessment->placement->company->name }}
                    </p>

                </div>


                @if ($assessment->placement->companyContact)

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Contact Person
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $assessment->placement->companyContact->name }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('assessments.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Assessments
        </a>


        <div class="flex flex-col sm:flex-row gap-3">

            <a
                href="{{ route('placements.show', $assessment->placement) }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
            >
                View Placement
            </a>


            <a
                href="{{ route('assessments.edit', $assessment) }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
            >
                Edit Assessment
            </a>

        </div>

    </div>

</x-app-layout>
