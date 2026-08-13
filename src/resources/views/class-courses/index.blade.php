<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Class Courses
                </h2>

                {{-- <p class="text-sm text-slate-500 mt-1">
                    Manage courses assigned to classes.
                </p> --}}

            </div>




        </div>

    </x-slot>

     <div class="flex flex-col gap-4 mb-6  sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    List of Class Courses
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Manage the course assignments.
                </p>
            </div>

              <a
                href="{{ route('class-courses.create') }}"
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

                Assign Course

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
            action="{{ route('class-courses.index') }}"
            class="grid grid-cols-1 lg:grid-cols-12 gap-4"
        >

            <div class="lg:col-span-4">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search class or course..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            <div class="lg:col-span-3">

                <select
                    name="class_room_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Classes
                    </option>

                    @foreach ($classRooms as $classRoom)

                        <option
                            value="{{ $classRoom->id }}"
                            @selected(
                                request('class_room_id') == $classRoom->id
                            )
                        >
                            {{ $classRoom->code }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="lg:col-span-3">

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
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="lg:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900 transition"
                >
                    Filter
                </button>

                @if(request()->hasAny([
                    'search',
                    'class_room_id',
                    'course_id',
                    'status'
                ]))

                    <a
                        href="{{ route('class-courses.index') }}"
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
                            Class
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Course
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

                    @forelse ($classCourses as $classCourse)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($classCourses->currentPage() - 1) * $classCourses->perPage() }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $classCourse->classRoom->code }}
                                </div>

                                <div class="text-sm text-slate-700 mt-1">
                                    {{ $classCourse->classRoom->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-slate-800">
                                    {{ $classCourse->course->code }}
                                </div>

                                <div class="text-sm text-slate-500 mt-1">
                                    {{ $classCourse->course->name }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $classCourse->course->credit_hours }}
                                    credit hours
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-medium text-slate-700">
                                    {{ $classCourse->classRoom->programme->code }}
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $classCourse->classRoom->programme->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                @if ($classCourse->status)

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
                                        href="{{ route('class-courses.show', $classCourse) }}"
                                        class="px-3 py-2 rounded-lg text-sm text-blue-600 hover:bg-blue-50"
                                    >
                                        View
                                    </a>

                                    <a
                                        href="{{ route('class-courses.edit', $classCourse) }}"
                                        class="px-3 py-2 rounded-lg text-sm text-amber-600 hover:bg-amber-50"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('class-courses.destroy', $classCourse) }}"
                                        onsubmit="return confirm('Remove this course from the class?');"
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
                                    No course assignments found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Assign a course to a class to get started.
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

        @forelse ($classCourses as $classCourse)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <div class="text-lg font-bold text-blue-600">
                            {{ $classCourse->course->code }}
                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $classCourse->course->name }}
                        </h3>

                    </div>


                    @if ($classCourse->status)

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
                            {{ $classCourse->classRoom->code }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Programme
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $classCourse->classRoom->programme->code }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Semester
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $classCourse->classRoom->semester->code }}
                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    <a
                        href="{{ route('class-courses.show', $classCourse) }}"
                        class="px-3 py-2 rounded-lg text-sm text-blue-600 bg-blue-50"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('class-courses.edit', $classCourse) }}"
                        class="px-3 py-2 rounded-lg text-sm text-amber-600 bg-amber-50"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('class-courses.destroy', $classCourse) }}"
                        onsubmit="return confirm('Remove this course from the class?');"
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
                    No course assignments found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Assign your first course.
                </p>

            </div>

        @endforelse

    </div>


    @if ($classCourses->hasPages())

        <div class="mt-6">
            {{ $classCourses->withQueryString()->links() }}
        </div>

    @endif

</x-app-layout>
