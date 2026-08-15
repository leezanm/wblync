<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Supervisor Details
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manage supervisor and assigned students.
                </p>

            </div>


            <a
                href="{{ route('supervisors.edit', $supervisor) }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700"
            >
                Edit Supervisor
            </a>

        </div>

    </x-slot>


    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Supervisor --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                <span class="text-2xl font-bold text-blue-600">
                    {{ strtoupper(substr($supervisor->lecturer?->name ?? 'S', 0, 1)) }}
                </span>

            </div>


            <div class="flex-1">

                <div class="flex flex-wrap items-center gap-3">

                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $supervisor->lecturer?->name ?? '-' }}
                    </h2>


                    @if ($supervisor->status === 'Active')

                        <span class="px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            Active
                        </span>

                    @else

                        <span class="px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </div>


                <p class="text-sm text-slate-500 mt-1">
                    Staff No: {{ $supervisor->lecturer?->staff_no ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Session --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

            <p class="text-xs uppercase tracking-wide text-slate-400 font-medium">
                Academic Session
            </p>

            <p class="mt-2 font-bold text-slate-800">
                {{ $supervisor->academicSession?->name ?? '-' }}
            </p>

        </div>


        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

            <p class="text-xs uppercase tracking-wide text-slate-400 font-medium">
                Semester
            </p>

            <p class="mt-2 font-bold text-slate-800">
                {{ $supervisor->semester?->name ?? '-' }}
            </p>

        </div>


        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

            <p class="text-xs uppercase tracking-wide text-slate-400 font-medium">
                Students
            </p>

            <p class="mt-2 font-bold text-blue-600 text-xl">
                {{ $supervisor->students->count() }}
            </p>

        </div>

    </div>


    {{-- Students --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mt-6 overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Students Under This Supervisor
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Students assigned for this semester.
                    </p>

                </div>


                <a
                    href="{{ route('supervisors.students.create', $supervisor) }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700"
                >
                    + Add Student
                </a>

            </div>

        </div>


        @if ($supervisor->students->count())

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs uppercase text-slate-500">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase text-slate-500">
                                Student
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase text-slate-500">
                                Student No
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase text-slate-500">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach ($supervisor->students as $assignment)

                            <tr>

                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="font-semibold text-slate-800">
                                        {{ $assignment->student?->name ?? '-' }}
                                    </div>

                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $assignment->student?->student_no ?? '-' }}
                                </td>

                                <td class="px-6 py-4">

                                    @if ($assignment->status === 'Active')

                                        <span class="px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                            Active
                                        </span>

                                    @else

                                        <span class="px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="p-12 text-center">

                <h3 class="font-semibold text-slate-700">
                    No students assigned
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add students under this supervisor.
                </p>

            </div>

        @endif

    </div>


    <div class="mt-6 mb-6">

        <a
            href="{{ route('supervisors.index') }}"
            class="inline-flex items-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50"
        >
            ← Back to Supervisors
        </a>

    </div>

</x-app-layout>
