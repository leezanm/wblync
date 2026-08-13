<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Enrollments
            </h2>

        </div>

    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                List of Enrollments
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Manage student course enrollments.
            </p>
        </div>

        <a
            href="{{ route('enrollments.create') }}"
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

            Enroll Student

        </a>
    </div>

    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mb-6">

        <form
            method="GET"
            action="{{ route('enrollments.index') }}"
            class="grid grid-cols-1 gap-4"
        >

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                <div class="lg:col-span-4">

                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search student or course..."
                        class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                    >

                </div>


                <div class="lg:col-span-2">

                    <select
                        name="student_id"
                        class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            All Students
                        </option>

                        @foreach ($students as $student)

                            <option
                                value="{{ $student->id }}"
                                @selected(
                                    request('student_id') == $student->id
                                )
                            >
                                {{ $student->student_no }}
                                -
                                {{ $student->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}
                <div class="lg:col-span-2">

                    <select
                        name="academic_session_id"
                        class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            All Sessions
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
                            All Semesters
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


                {{-- Course --}}
                <div class="lg:col-span-2">

                    <select
                        name="course_id"
                        class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            All Courses
                        </option>

                        @foreach ($courses as $course)

                            <option
                                value="{{ $course->id }}"
                                @selected(
                                    request('course_id') == $course->id
                                )
                            >
                                {{ $course->code }}
                                -
                                {{ $course->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="flex justify-end gap-2">

                <button
                    type="submit"
                    class="px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900 transition"
                >
                    Filter
                </button>

                @if(request()->hasAny([
                    'search',
                    'student_id',
                    'academic_session_id',
                    'semester_id',
                    'course_id',
                    'status'
                ]))

                    <a
                        href="{{ route('enrollments.index') }}"
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
                            Class
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Course
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

                    @forelse ($enrollments as $enrollment)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($enrollments->currentPage() - 1) * $enrollments->perPage() }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $enrollment->student->student_no }}
                                </div>

                                <div class="text-sm text-slate-700 mt-1">
                                    {{ $enrollment->student->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-medium text-slate-700">
                                    {{ $enrollment->student->classRoom->code }}
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $enrollment->student->classRoom->semester->code }}
                                    ·
                                    {{ $enrollment->student->classRoom->academicSession->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-slate-800">
                                    {{ $enrollment->classCourse->course->code }}
                                </div>

                                <div class="text-sm text-slate-500 mt-1">
                                    {{ $enrollment->classCourse->course->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                @if ($enrollment->status)

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
                                        href="{{ route('enrollments.show', $enrollment) }}"
                                        class="px-3 py-2 rounded-lg text-sm text-blue-600 hover:bg-blue-50"
                                    >
                                        View
                                    </a>

                                    <a
                                        href="{{ route('enrollments.edit', $enrollment) }}"
                                        class="px-3 py-2 rounded-lg text-sm text-amber-600 hover:bg-amber-50"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('enrollments.destroy', $enrollment) }}"
                                        onsubmit="return confirm('Remove this enrollment?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-2 rounded-lg text-sm text-red-600 hover:bg-red-50"
                                        >
                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No enrollments found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Enroll a student into a course to get started.
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

        @forelse ($enrollments as $enrollment)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <div class="text-lg font-bold text-blue-600">
                            {{ $enrollment->student->student_no }}
                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $enrollment->student->name }}
                        </h3>

                    </div>


                    @if ($enrollment->status)

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
                            Class
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $enrollment->student->classRoom->code }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Course
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $enrollment->classCourse->course->code }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Semester
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $enrollment->student->classRoom->semester->code }}
                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    <a
                        href="{{ route('enrollments.show', $enrollment) }}"
                        class="px-3 py-2 rounded-lg text-sm text-blue-600 bg-blue-50"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('enrollments.edit', $enrollment) }}"
                        class="px-3 py-2 rounded-lg text-sm text-amber-600 bg-amber-50"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('enrollments.destroy', $enrollment) }}"
                        onsubmit="return confirm('Remove this enrollment?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-3 py-2 rounded-lg text-sm text-red-600 bg-red-50"
                        >
                            Remove
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No enrollments found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Enroll your first student.
                </p>

            </div>

        @endforelse

    </div>


    @if ($enrollments->hasPages())

        <div class="mt-6">
            {{ $enrollments->withQueryString()->links() }}
        </div>

    @endif

</x-app-layout>
