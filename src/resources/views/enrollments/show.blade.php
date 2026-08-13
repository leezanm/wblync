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
                Enrollment Details
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                View the selected enrollment information.
            </p>
        </div>

        <a
            href="{{ route('enrollments.edit', $enrollment) }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
        >
            Edit Enrollment
        </a>

    </div>


    <div class="max-w-4xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="p-6 sm:p-8 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <p class="text-sm text-slate-500">
                            Student
                        </p>

                        <p class="text-3xl font-bold text-blue-600 mt-1">
                            {{ $enrollment->student->student_no }}
                        </p>

                        <p class="text-sm text-slate-600 mt-1">
                            {{ $enrollment->student->name }}
                        </p>

                    </div>


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

                </div>

            </div>


            <div class="p-6 sm:p-8">

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-7">

                    <div>

                        <dt class="text-sm text-slate-500">
                            Class
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $enrollment->student->classRoom->code }}
                            -
                            {{ $enrollment->student->classRoom->name }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Course
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $enrollment->classCourse->course->code }}
                            -
                            {{ $enrollment->classCourse->course->name }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Academic Session
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $enrollment->student->classRoom->academicSession->name }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Semester
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $enrollment->student->classRoom->semester->code }}
                            -
                            {{ $enrollment->student->classRoom->semester->name }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Programme
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $enrollment->student->classRoom->programme->code }}
                            -
                            {{ $enrollment->student->classRoom->programme->name }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Credit Hours
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $enrollment->classCourse->course->credit_hours }}
                        </dd>

                    </div>

                </dl>

            </div>


            <div class="px-6 sm:px-8 py-5 bg-slate-50 border-t border-slate-100">

                <a
                    href="{{ route('enrollments.index') }}"
                    class="text-sm font-medium text-slate-600 hover:text-slate-900"
                >
                    ← Back to Enrollments
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
