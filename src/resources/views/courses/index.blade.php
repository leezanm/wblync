<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Courses
                </h2>

                {{-- <p class="text-sm text-slate-500 mt-1">
                    Manage courses offered under each programme.
                </p> --}}
            </div>


        </div>

    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                List of Courses
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Manage courses offered under each programme.
            </p>
        </div>

        <a
            href="{{ route('courses.create') }}"
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

            Add Course

        </a>
    </div>

    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-green-800">

            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            action="{{ route('courses.index') }}"
            class="grid grid-cols-1 lg:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="lg:col-span-5 relative">

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
                    placeholder="Search course code or name..."
                    class="w-full pl-10 pr-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Programme --}}
            <div class="lg:col-span-3">

                <select
                    name="programme_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Programmes
                    </option>

                    @foreach ($programmes as $programme)

                        <option
                            value="{{ $programme->id }}"
                            @selected(request('programme_id') == $programme->id)
                        >
                            {{ $programme->code }} - {{ $programme->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div class="lg:col-span-2">

                <select
                    name="status"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="1"
                        @selected(request('status') === '1')
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        @selected(request('status') === '0')
                    >
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Buttons --}}
            <div class="lg:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900 transition"
                >
                    Filter
                </button>

                @if(request()->hasAny(['search', 'programme_id', 'status']))

                    <a
                        href="{{ route('courses.index') }}"
                        class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition"
                    >
                        Clear
                    </a>

                @endif

            </div>


        </form>

    </div>


    {{-- Desktop Table --}}
    <div class="hidden md:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Code
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Course
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Programme
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Credits
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

                    @forelse ($courses as $course)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($courses->currentPage() - 1) * $courses->perPage() }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="font-semibold text-blue-600">
                                    {{ $course->code }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $course->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <div class="text-sm font-medium text-slate-700">
                                    {{ $course->programme->code }}
                                </div>

                                <div class="text-xs text-slate-500 mt-0.5">
                                    {{ $course->programme->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-sm font-semibold">
                                    {{ $course->credit_hours }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                @if($course->status)

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

                                    {{-- View --}}
                                    <a
                                        href="{{ route('courses.show', $course) }}"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition"
                                        title="View"
                                    >

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

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


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('courses.edit', $course) }}"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-amber-50 hover:text-amber-600 transition"
                                        title="Edit"
                                    >

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M4 20h4l10.5-10.5a2.1 2.1 0 00-3-3L5 17v3z"
                                            />

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('courses.destroy', $course) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this course?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
                                            title="Delete"
                                        >

                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

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

                            <td colspan="7" class="px-6 py-16 text-center">

                                <h3 class="font-semibold text-slate-700">
                                    No courses found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Create your first course to get started.
                                </p>

                                <a
                                    href="{{ route('courses.create') }}"
                                    class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    Create Course
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile Cards --}}
    <div class="md:hidden bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        @forelse ($courses as $course)

            <div class="p-5 border-b border-slate-100 last:border-0">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <span class="text-sm font-bold text-blue-600">
                            {{ $course->code }}
                        </span>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $course->name }}
                        </h3>

                    </div>


                    @if($course->status)

                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            Active
                        </span>

                    @else

                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </div>


                <div class="mt-4 space-y-2 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Programme
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $course->programme->code }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Credit Hours
                        </span>

                        <span class="font-medium text-slate-700">
                            {{ $course->credit_hours }}
                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5">

                    <a
                        href="{{ route('courses.show', $course) }}"
                        class="px-3 py-2 rounded-lg text-sm text-blue-600 bg-blue-50"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('courses.edit', $course) }}"
                        class="px-3 py-2 rounded-lg text-sm text-amber-600 bg-amber-50"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('courses.destroy', $course) }}"
                        onsubmit="return confirm('Are you sure you want to delete this course?');"
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

            <div class="p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No courses found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Create your first course.
                </p>

                <a
                    href="{{ route('courses.create') }}"
                    class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    Create Course
                </a>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($courses->hasPages())

        <div class="mt-6">
            {{ $courses->withQueryString()->links() }}
        </div>

    @endif

</x-app-layout>
