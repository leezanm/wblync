<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Placements
                </h2>

            </div>


            <a
                href="{{ route('placements.create') }}"
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

                Add Placement

            </a>

        </div>

    </x-slot>


    {{-- Page Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                List of Placements
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage student WBL industry placements.
            </p>

        </div>


        <a
            href="{{ route('placements.create') }}"
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

            Add Placement

        </a>

    </div>


    {{-- Success Message --}}
    @if (session('success'))

        <div class="mb-6 mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">

            {{ session('success') }}

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mt-6 mb-6">

        <form
            method="GET"
            action="{{ route('placements.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="md:col-span-5">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search student or company..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Status --}}
            <div class="md:col-span-3">

                <select
                    name="status"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Status
                    </option>

                    @foreach ([
                        'Draft',
                        'Applied',
                        'Approved',
                        'Rejected',
                        'Active',
                        'Completed',
                        'Cancelled',
                    ] as $status)

                        <option
                            value="{{ $status }}"
                            @selected(request('status') === $status)
                        >
                            {{ $status }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Academic Session --}}
            <div class="md:col-span-3">

                <select
                    name="academic_session_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Academic Sessions
                    </option>

                    {{-- @foreach (
                        \App\Models\AcademicSession::query()
                            ->orderByDesc('start_date')
                            ->get()
                        as $session
                    ) --}}
@foreach ($academicSessions as $session)
                        <option
                            value="{{ $session->id }}"
                            @selected(
                                (string) request('academic_session_id')
                                === (string) $session->id
                            )
                        >
                            {{ $session->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Filter Button --}}
            <div class="md:col-span-1 flex gap-2">

                <button
                    type="submit"
                    class="w-full px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900"
                >
                    Filter
                </button>

            </div>

        </form>


        @if(request()->hasAny([
            'search',
            'status',
            'academic_session_id'
        ]))

            <div class="mt-4">

                <a
                    href="{{ route('placements.index') }}"
                    class="text-sm font-medium text-slate-500 hover:text-slate-800"
                >
                    Clear filters
                </a>

            </div>

        @endif

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
                            Academic Session
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Period
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

                    @forelse ($placements as $placement)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($placements->currentPage() - 1) * $placements->perPage() }}

                            </td>


                            {{-- Student --}}
                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">

                                    {{ $placement->student->student_no }}

                                </div>

                                <div class="text-sm text-slate-700 mt-1">

                                    {{ $placement->student->name }}

                                </div>

                            </td>


                            {{-- Company --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">

                                    {{ $placement->company->name }}

                                </div>

                                <div class="text-xs text-slate-400 mt-1">

                                    {{ $placement->company->code }}

                                </div>

                            </td>


                            {{-- Academic Session --}}
                            <td class="px-6 py-4 text-sm text-slate-600">

                                {{ $placement->academicSession->name }}

                            </td>


                            {{-- Period --}}
                            <td class="px-6 py-4">

                                <div class="text-sm font-medium text-slate-700">

                                    {{ $placement->start_date->format('d/m/Y') }}

                                </div>

                                <div class="text-xs text-slate-400 mt-1">

                                    to {{ $placement->end_date->format('d/m/Y') }}

                                </div>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @php

                                    $statusClasses = [
                                        'Draft' =>
                                            'bg-slate-100 text-slate-600',

                                        'Applied' =>
                                            'bg-blue-100 text-blue-700',

                                        'Approved' =>
                                            'bg-indigo-100 text-indigo-700',

                                        'Rejected' =>
                                            'bg-red-100 text-red-700',

                                        'Active' =>
                                            'bg-green-100 text-green-700',

                                        'Completed' =>
                                            'bg-purple-100 text-purple-700',

                                        'Cancelled' =>
                                            'bg-orange-100 text-orange-700',
                                    ];

                                @endphp


                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClasses[$placement->status] ?? 'bg-slate-100 text-slate-600' }}"
                                >

                                    <span class="w-2 h-2 rounded-full bg-current opacity-70"></span>

                                    {{ $placement->status }}

                                </span>

                            </td>


                            {{-- Action --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('placements.show', $placement) }}"
                                        title="View"
                                        aria-label="View placement"
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
                                        href="{{ route('placements.edit', $placement) }}"
                                        title="Edit"
                                        aria-label="Edit placement"
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
                                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                            />

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('placements.destroy', $placement) }}"
                                        onsubmit="return confirm('Delete this placement?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            aria-label="Delete placement"
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
                                                    d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
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
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No placements found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add a placement to get started.
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

        @forelse ($placements as $placement)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                {{-- Header --}}
                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <div class="text-sm font-bold text-blue-600">

                            {{ $placement->student->student_no }}

                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">

                            {{ $placement->student->name }}

                        </h3>

                    </div>


                    @php

                        $statusClasses = [
                            'Draft' =>
                                'bg-slate-100 text-slate-600',

                            'Applied' =>
                                'bg-blue-100 text-blue-700',

                            'Approved' =>
                                'bg-indigo-100 text-indigo-700',

                            'Rejected' =>
                                'bg-red-100 text-red-700',

                            'Active' =>
                                'bg-green-100 text-green-700',

                            'Completed' =>
                                'bg-purple-100 text-purple-700',

                            'Cancelled' =>
                                'bg-orange-100 text-orange-700',
                        ];

                    @endphp


                    <span
                        class="shrink-0 px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$placement->status] ?? 'bg-slate-100 text-slate-600' }}"
                    >
                        {{ $placement->status }}
                    </span>

                </div>


                {{-- Details --}}
                <div class="mt-5 space-y-3 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Company
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $placement->company->name }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Session
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $placement->academicSession->name }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Period
                        </span>

                        <span class="font-medium text-slate-700 text-right">

                            {{ $placement->start_date->format('d/m/Y') }}

                            -

                            {{ $placement->end_date->format('d/m/Y') }}

                        </span>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    {{-- View --}}
                    <a
                        href="{{ route('placements.show', $placement) }}"
                        title="View"
                        aria-label="View placement"
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
                        href="{{ route('placements.edit', $placement) }}"
                        title="Edit"
                        aria-label="Edit placement"
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
                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l1-4L16.5 3.5z"
                            />

                        </svg>

                    </a>


                    {{-- Delete --}}
                    <form
                        method="POST"
                        action="{{ route('placements.destroy', $placement) }}"
                        onsubmit="return confirm('Delete this placement?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            title="Delete"
                            aria-label="Delete placement"
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
                                    d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                />

                            </svg>

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No placements found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add a placement to get started.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($placements->hasPages())

        <div class="mt-6">

            {{ $placements->withQueryString()->links() }}

        </div>

    @endif

</x-app-layout>
