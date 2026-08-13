<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    Students
                </h2>

                {{-- <p class="text-sm text-slate-500 mt-1">
                    Student details
                </p> --}}

            </div>





        </div>

    </x-slot>
    <div class="flex flex-col gap-4 mb-6  sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Students Details
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                View the selected student information.
            </p>
        </div>
        <a
                href="{{ route('students.edit', $student) }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
            >
                Edit Student
            </a>

    </div>

    <div class="max-w-full">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="p-6 sm:p-8 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <p class="text-sm text-slate-500">
                            Student Number
                        </p>

                        <p class="text-3xl font-bold text-blue-600 mt-1">
                            {{ $student->student_no }}
                        </p>

                    </div>


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


            <div class="p-6 sm:p-8">

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-7">

                    <div>
                        <dt class="text-sm text-slate-500">
                            Student Name
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->name }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            IC Number
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->ic_no ?: '—' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            Email
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800 break-all">
                            {{ $student->email ?: '—' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            Phone
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->phone ?: '—' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            Class
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->classRoom->code }}
                            -
                            {{ $student->classRoom->name }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            Academic Session
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->classRoom->academicSession->name }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            Semester
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->classRoom->semester->code }}
                            -
                            {{ $student->classRoom->semester->name }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-sm text-slate-500">
                            Programme
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $student->classRoom->programme->code }}
                            -
                            {{ $student->classRoom->programme->name }}
                        </dd>
                    </div>

                </dl>

            </div>


            <div class="px-6 sm:px-8 py-5 bg-slate-50 border-t border-slate-100">

                <a
                    href="{{ route('students.index') }}"
                    class="text-sm font-medium text-slate-600 hover:text-slate-900"
                >
                    ← Back to Students
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
