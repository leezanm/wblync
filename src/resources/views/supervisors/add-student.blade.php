<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
               Supervisor
            </h2>



        </div>

    </x-slot>

  <div>

            <h2 class="text-2xl font-bold text-slate-800">
               Add Student
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Assign a student to this supervisor.
            </p>

        </div>
    <div class="max-w-2xl mx-auto mt-6">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <div class="mb-8">

                <p class="text-xs uppercase tracking-wide text-slate-400">
                    Supervisor
                </p>

                <h3 class="text-xl font-bold text-slate-800 mt-1">
                    {{ $supervisor->lecturer?->name }}
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $supervisor->academicSession?->name }}
                    ·
                    {{ $supervisor->semester?->name }}
                </p>

            </div>


            @if ($students->count())

                <form
                    method="POST"
                    action="{{ route('supervisors.students.store', $supervisor) }}"
                >

                    @csrf


                    <div>

                        <label
                            for="student_id"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Student
                        </label>


                        <select
                            id="student_id"
                            name="student_id"
                            required
                            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                        >

                            <option value="">
                                Select student
                            </option>

                            @foreach ($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    @selected(old('student_id') == $student->id)
                                >
                                    {{ $student->student_no }}
                                    -
                                    {{ $student->name }}
                                </option>

                            @endforeach

                        </select>


                        @error('student_id')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

                        <a
                            href="{{ route('supervisors.show', $supervisor) }}"
                            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700"
                        >
                            Assign Student
                        </button>

                    </div>

                </form>

            @else

                <div class="rounded-xl bg-slate-50 border border-slate-200 p-6 text-center">

                    <h3 class="font-semibold text-slate-700">
                        No available students
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        All available students have already been assigned to this supervisor.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
