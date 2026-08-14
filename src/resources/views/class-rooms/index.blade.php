<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Classes
                </h2>

                {{-- <p class="text-sm text-slate-500 mt-1">
                    Manage classes by academic session, semester and programme.
                </p> --}}

            </div>


        </div>

    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                List of Classes
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Manage classes by academic session, semester and programme.
            </p>
        </div>

        <a
            href="{{ route('classes.create') }}"
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

            Add Class

        </a>
    </div>
    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-green-800">

            <svg
                class="w-5 h-5 mt-0.5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mt-6 p-5 mb-6">

        <form
            method="GET"
            action="{{ route('classes.index') }}"
            class="grid grid-cols-1 lg:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="lg:col-span-4 relative">

                <svg
                    class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 11-13.5 0 6.75 6.75 0 0113.5 0z"
                    />
                </svg>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search class..."
                    class="w-full pl-10 pr-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Academic Session --}}
            <div class="lg:col-span-2">

                <select
                    name="academic_session_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Session
                    </option>

                    @foreach ($academicSessions as $academicSession)

                        <option
                            value="{{ $academicSession->id }}"
                            @selected(
                                request('academic_session_id') == $academicSession->id
                            )
                        >
                            {{ $academicSession->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Semester --}}
            <div class="lg:col-span-2">

                <select
                    name="semester_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Semester
                    </option>

                    @foreach ($semesters as $semester)

                        <option
                            value="{{ $semester->id }}"
                            @selected(
                                request('semester_id') == $semester->id
                            )
                        >
                            {{ $semester->code }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Programme --}}
            <div class="lg:col-span-2">

                <select
                    name="programme_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Programme
                    </option>

                    @foreach ($programmes as $programme)

                        <option
                            value="{{ $programme->id }}"
                            @selected(
                                request('programme_id') == $programme->id
                            )
                        >
                            {{ $programme->code }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Filter --}}
            <div class="lg:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900 transition"
                >
                    Filter
                </button>

                @if(request()->hasAny([
                    'search',
                    'academic_session_id',
                    'semester_id',
                    'programme_id',
                    'status'
                ]))

                    <a
                        href="{{ route('classes.index') }}"
                        class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition"
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
                            Class
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Academic Session
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Semester
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Programme
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

                    @forelse ($classRooms as $class)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($classRooms->currentPage() - 1) * $classRooms->perPage() }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $class->code }}
                                </div>

                                <div class="text-sm text-slate-700 mt-1">
                                    {{ $class->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <span class="text-sm font-medium text-slate-700">
                                    {{ $class->academicSession?->name ?? '-' }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                <span class="text-sm font-medium text-slate-700">
                                    {{ $class->semester?->code ?? '-' }}
                                </span>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $class->semester?->name ?? '-' }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <span class="text-sm font-medium text-slate-700">
                                    {{ $class->programme?->code ?? '-' }}
                                </span>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $class->programme?->name ?? '-' }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                @if ($class->status)

                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    <a
                                        href="{{ route('classes.show', $class) }}"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition"
                                        title="View"
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
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            />
                                        </svg>
                                    </a>


                                    <a
                                        href="{{ route('classes.edit', $class) }}"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-amber-50 hover:text-amber-600 transition"
                                        title="Edit"
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
                                                d="M4 20h4l10.5-10.5a2.1 2.1 0 00-3-3L5 17v3z"
                                            />
                                        </svg>
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('classes.destroy', $class) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this class?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
                                            title="Delete"
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
                                                    d="M4 7h16M10 11v6M14 11v6M9 7V4h6v3M6 7l1 14h10l1-14"
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

                                <div class="text-slate-400 mb-3">
                                    <svg
                                        class="w-12 h-12 mx-auto"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M4 6.75A2.75 2.75 0 016.75 4h10.5A2.75 2.75 0 0120 6.75v10.5A2.75 2.75 0 0117.25 20H6.75A2.75 2.75 0 014 17.25V6.75z"
                                        />
                                    </svg>
                                </div>

                                <h3 class="font-semibold text-slate-700">
                                    No classes found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Create your first class to get started.
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

        @forelse ($classRooms as $class)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <div class="text-lg font-bold text-blue-600">
                            {{ $class->code }}
                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $class->name }}
                        </h3>

                    </div>


                    @if ($class->status)

                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            Active
                        </span>

                    @else

                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </div>


                <div class="mt-5 space-y-3 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Academic Session
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $class->academicSession?->name ?? '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Semester
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $class->semester?->code ?? '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Programme
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $class->programme?->code ?? '-' }}
                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    <a
                        href="{{ route('classes.show', $class) }}"
                        class="px-3 py-2 rounded-lg text-sm text-blue-600 bg-blue-50"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('classes.edit', $class) }}"
                        class="px-3 py-2 rounded-lg text-sm text-amber-600 bg-amber-50"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('classes.destroy', $class) }}"
                        onsubmit="return confirm('Are you sure you want to delete this class?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-3 py-2 rounded-lg text-sm text-red-600 bg-red-50"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No classes found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Create your first class.
                </p>

            </div>

        @endforelse

    </div>


    @if ($classRooms->hasPages())

        <div class="mt-6">
            {{ $classRooms->withQueryString()->links() }}
        </div>

    @endif

</x-app-layout>
