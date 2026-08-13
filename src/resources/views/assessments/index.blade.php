<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Assessments
                </h2>

            </div>


            <a
                href="{{ route('assessments.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
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

                Add Assessment

            </a>

        </div>

    </x-slot>


    {{-- Page Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                List of Assessments
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage WBL student assessments and evaluation records.
            </p>

        </div>


        <a
            href="{{ route('assessments.create') }}"
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

            Add Assessment

        </a>

    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">

            {{ session('success') }}

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mt-6 mb-6">

        <form
            method="GET"
            action="{{ route('assessments.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="md:col-span-8">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search student, student no. or company..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Status --}}
            <div class="md:col-span-2">

                <select
                    name="status"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="Draft"
                        @selected(request('status') === 'Draft')
                    >
                        Draft
                    </option>

                    <option
                        value="Submitted"
                        @selected(request('status') === 'Submitted')
                    >
                        Submitted
                    </option>

                    <option
                        value="Completed"
                        @selected(request('status') === 'Completed')
                    >
                        Completed
                    </option>

                </select>

            </div>


            {{-- Filter --}}
            <div class="md:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900"
                >
                    Filter
                </button>


                @if(request()->hasAny(['search', 'status']))

                    <a
                        href="{{ route('assessments.index') }}"
                        class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50"
                    >
                        Clear
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- Desktop --}}
    <div class="hidden md:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Student
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Assessment Date
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Score
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Grade
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($assessments as $assessment)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($assessments->currentPage() - 1) * $assessments->perPage() }}

                            </td>


                            {{-- Student --}}
                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">

                                    {{ $assessment->placement->student->student_no }}

                                </div>

                                <div class="text-sm text-slate-700 mt-1">

                                    {{ $assessment->placement->student->name }}

                                </div>

                            </td>


                            {{-- Company --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">

                                    {{ $assessment->placement->company->name }}

                                </div>

                                <div class="text-xs text-slate-400 mt-1">

                                    {{ $assessment->placement->company->code }}

                                </div>

                            </td>


                            {{-- Date --}}
                            <td class="px-6 py-4 text-sm text-slate-600">

                                {{ $assessment->assessment_date->format('d/m/Y') }}

                            </td>


                            {{-- Score --}}
                            <td class="px-6 py-4">

                                @if ($assessment->score !== null)

                                    <span class="font-bold text-slate-800">

                                        {{ number_format((float) $assessment->score, 2) }}

                                    </span>

                                @else

                                    <span class="text-sm text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Grade --}}
                            <td class="px-6 py-4">

                                @if ($assessment->grade)

                                    <span class="inline-flex items-center justify-center min-w-10 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-sm font-bold">

                                        {{ $assessment->grade }}

                                    </span>

                                @else

                                    <span class="text-sm text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @php

                                    $statusClasses = [
                                        'Draft' =>
                                            'bg-slate-100 text-slate-600',

                                        'Submitted' =>
                                            'bg-blue-100 text-blue-700',

                                        'Completed' =>
                                            'bg-green-100 text-green-700',
                                    ];

                                @endphp


                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses[$assessment->status] ?? 'bg-slate-100 text-slate-600' }}"
                                >

                                    <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                                    {{ $assessment->status }}

                                </span>

                            </td>


                            {{-- Action --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('assessments.show', $assessment) }}"
                                        title="View"
                                        aria-label="View assessment"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 hover:bg-blue-50"
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
                                                d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                                stroke-width="1.8"
                                            />

                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('assessments.edit', $assessment) }}"
                                        title="Edit"
                                        aria-label="Edit assessment"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 hover:bg-amber-50"
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
                                                d="M12 20h9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                                            />

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('assessments.destroy', $assessment) }}"
                                        onsubmit="return confirm('Delete this assessment?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            aria-label="Delete assessment"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50"
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
                                                    d="M4 7h16M10 11v6M14 11v6M6 7v13h12V7M9 7V4h6v3"
                                                />

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No assessments found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first assessment to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile --}}
    <div class="md:hidden space-y-4">

        @forelse ($assessments as $assessment)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <div class="text-sm font-bold text-blue-600">

                            {{ $assessment->placement->student->student_no }}

                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">

                            {{ $assessment->placement->student->name }}

                        </h3>

                        <p class="text-sm text-slate-500 mt-1">

                            {{ $assessment->placement->company->name }}

                        </p>

                    </div>


                    @php

                        $statusClasses = [
                            'Draft' =>
                                'bg-slate-100 text-slate-600',

                            'Submitted' =>
                                'bg-blue-100 text-blue-700',

                            'Completed' =>
                                'bg-green-100 text-green-700',
                        ];

                    @endphp


                    <span
                        class="shrink-0 px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$assessment->status] ?? 'bg-slate-100 text-slate-600' }}"
                    >
                        {{ $assessment->status }}
                    </span>

                </div>


                <div class="mt-5 space-y-3 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Assessment Date
                        </span>

                        <span class="font-medium text-slate-700 text-right">

                            {{ $assessment->assessment_date->format('d/m/Y') }}

                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Score
                        </span>

                        <span class="font-medium text-slate-700 text-right">

                            {{ $assessment->score !== null
                                ? number_format((float) $assessment->score, 2)
                                : '-' }}

                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Grade
                        </span>

                        <span class="font-bold text-blue-600 text-right">

                            {{ $assessment->grade ?: '-' }}

                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    {{-- View --}}
                    <a
                        href="{{ route('assessments.show', $assessment) }}"
                        title="View"
                        aria-label="View assessment"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 bg-blue-50"
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
                                d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12z"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="2.5"
                                stroke-width="1.8"
                            />

                        </svg>

                    </a>


                    {{-- Edit --}}
                    <a
                        href="{{ route('assessments.edit', $assessment) }}"
                        title="Edit"
                        aria-label="Edit assessment"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 bg-amber-50"
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
                                d="M12 20h9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                            />

                        </svg>

                    </a>


                    {{-- Delete --}}
                    <form
                        method="POST"
                        action="{{ route('assessments.destroy', $assessment) }}"
                        onsubmit="return confirm('Delete this assessment?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            title="Delete"
                            aria-label="Delete assessment"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 bg-red-50"
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
                                    d="M4 7h16M10 11v6M14 11v6M6 7v13h12V7M9 7V4h6v3"
                                />

                            </svg>

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No assessments found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add your first assessment to get started.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($assessments->hasPages())

        <div class="mt-6">

            {{ $assessments->withQueryString()->links() }}

        </div>

    @endif

</x-app-layout>
