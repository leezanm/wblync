<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <p class="text-sm font-semibold text-blue-600">
                    Academic Profile
                </p>


            </div>


        </div>

    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

        <div>

            <p class="text-sm font-semibold text-blue-600">
                Academic Profile
            </p>


        </div>
            @role('Superadmin')
            <a
                href="{{ route('students.index') }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium hover:bg-slate-50 transition"
            >
                ← Back to Students
            </a>
            @endrole

    </div>
    <div class="space-y-6">


        {{-- Student Summary --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">

                    <span class="text-2xl font-bold text-blue-600">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </span>

                </div>


                <div class="min-w-0">

                    <h3 class="text-xl font-bold text-slate-800">
                        {{ $student->name }}
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Student No:
                        <span class="font-medium text-slate-700">
                            {{ $student->student_no }}
                        </span>
                    </p>

                </div>


                <div class="sm:ml-auto">

                    @if ($student->status)

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            Active

                        </span>

                    @else

                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- Academic Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

            <div class="px-6 py-5 border-b border-slate-100">

                <h3 class="font-bold text-slate-800">
                    Academic Information
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Current academic placement of the student.
                </p>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


                    {{-- Class --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Class
                        </p>

                        @if ($student->classRoom)

                            <p class="mt-2 font-bold text-blue-600">
                                {{ $student->classRoom->code }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $student->classRoom->name }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-slate-400">
                                Not assigned
                            </p>

                        @endif

                    </div>


                    {{-- Programme --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Programme
                        </p>

                        @if ($student->classRoom?->programme)

                            <p class="mt-2 font-bold text-slate-800">
                                {{ $student->classRoom->programme->code }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $student->classRoom->programme->name }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-slate-400">
                                Not assigned
                            </p>

                        @endif

                    </div>


                    {{-- Academic Session --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Academic Session
                        </p>

                        @if ($student->classRoom?->academicSession)

                            <p class="mt-2 font-bold text-slate-800">
                                {{ $student->classRoom->academicSession->name }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $student->classRoom->academicSession->code }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-slate-400">
                                Not assigned
                            </p>

                        @endif

                    </div>


                    {{-- Semester --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Semester
                        </p>

                        @if ($student->classRoom?->semester)

                            <p class="mt-2 font-bold text-slate-800">
                                {{ $student->classRoom->semester->code }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $student->classRoom->semester->name }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-slate-400">
                                Not assigned
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Enrolled Courses --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="font-bold text-slate-800">
                            Enrolled Courses
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Courses currently enrolled by this student.
                        </p>

                    </div>


                    <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                        {{ $student->enrollments->count() }}
                        {{ $student->enrollments->count() === 1 ? 'Course' : 'Courses' }}

                    </span>

                </div>

            </div>


            {{-- Desktop --}}
            <div class="hidden md:block overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Course
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Credit Hours
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($student->enrollments as $enrollment)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $loop->iteration }}
                                </td>


                                <td class="px-6 py-4">

                                    <div class="font-bold text-blue-600">
                                        {{ $enrollment->classCourse->course->code }}
                                    </div>

                                    <div class="text-sm text-slate-600 mt-1">
                                        {{ $enrollment->classCourse->course->name }}
                                    </div>

                                </td>


                                <td class="px-6 py-4 text-sm font-medium text-slate-700">

                                    {{ $enrollment->classCourse->course->credit_hours }}

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

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="px-6 py-14 text-center"
                                >

                                    <h3 class="font-semibold text-slate-700">
                                        No enrolled courses
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        This student has not been enrolled in any course.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Mobile --}}
            <div class="md:hidden divide-y divide-slate-100">

                @forelse ($student->enrollments as $enrollment)

                    <div class="p-5">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p class="font-bold text-blue-600">
                                    {{ $enrollment->classCourse->course->code }}
                                </p>

                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ $enrollment->classCourse->course->name }}
                                </p>

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


                        <div class="mt-4">

                            <p class="text-xs text-slate-500">
                                Credit Hours
                            </p>

                            <p class="text-sm font-semibold text-slate-700 mt-1">
                                {{ $enrollment->classCourse->course->credit_hours }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="p-10 text-center">

                        <h3 class="font-semibold text-slate-700">
                            No enrolled courses
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            This student has not been enrolled in any course.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Quick Actions --}}
        @role('Super Admin')
        <div class="flex flex-col sm:flex-row gap-3">

            <a
                href="{{ route('students.show', $student) }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium hover:bg-slate-50 transition"
            >
                View Student
            </a>

            <a
                href="{{ route('enrollments.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
            >
                Enroll in Course
            </a>

        </div>
        @endrole

    </div>

</x-app-layout>
