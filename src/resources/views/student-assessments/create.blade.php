<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            New Student Assessment
        </h3>
    </x-slot>

    <div class="mx-auto max-w-4xl p-6">

        <div class="mb-6">

            <h1 class="text-2xl font-semibold">
                New Student Assessment
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Create a new assessment for a student.
            </p>

        </div>


        @if ($errors->any())

            <div class="mb-6 rounded-md bg-red-50 p-4">

                <ul class="list-disc pl-5 text-sm text-red-700">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form method="POST" action="{{ route('student-assessments.store') }}" class="rounded-lg border bg-white p-6">

            @csrf


            <div class="space-y-6">

                {{-- Student Enrollment --}}

                <div>

                    <label class="block text-sm font-medium">
                        Student Enrollment
                    </label>

                    <select name="student_enrollment_id" required class="mt-1 block w-full rounded-md border-gray-300">

                        <option value="">
                            Select Student
                        </option>

                        @foreach ($enrollments as $enrollment)
                            <option value="{{ $enrollment->id }}" @selected(old('student_enrollment_id') == $enrollment->id)>
                                {{ $enrollment->student->student_no }}
                                —
                                {{ $enrollment->student->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- Assessment Version --}}

                <div>

                    <label class="block text-sm font-medium">
                        Assessment
                    </label>

                    <select name="assessment_version_id" required class="mt-1 block w-full rounded-md border-gray-300">

                        <option value="">
                            Select Assessment
                        </option>

                        @foreach ($assessmentVersions as $version)
                            <option value="{{ $version->id }}" @selected(old('assessment_version_id') == $version->id)>
                                {{ $version->assessmentTemplate->code }}
                                —
                                {{ $version->assessmentTemplate->name }}
                                —
                                Version {{ $version->version }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- Assessor Type --}}

                <div>

                    <label class="block text-sm font-medium">
                        Assessor Type
                    </label>

                    <select name="assessor_type" required class="mt-1 block w-full rounded-md border-gray-300">

                        <option value="">
                            Select Assessor Type
                        </option>

                        <option value="INDUSTRY_MENTOR" selected @selected(old('assessor_type') === 'INDUSTRY_MENTOR')>
                            Industry Mentor
                        </option>

                        <option value="LECTURER" @selected(old('assessor_type') === 'LECTURER')>
                            Lecturer
                        </option>

                        <option value="INTERNAL_ASSESSOR" @selected(old('assessor_type') === 'INTERNAL_ASSESSOR')>
                            Internal Assessor
                        </option>

                    </select>

                </div>


                {{-- Assessor ID --}}
                {{-- Assessor --}}

                <div class="rounded-lg bg-gray-50 p-4">

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Assessor
                    </p>

                    <p class="mt-1 font-medium">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Industry Mentor
                    </p>

                </div>

                {{-- <div>

                    <label class="block text-sm font-medium">
                        Assessor ID
                    </label>

                    <input
                        type="number"
                        name="assessor_id"
                        value="{{ old('assessor_id') }}"
                        class="mt-1 block w-full rounded-md border-gray-300"
                        placeholder="Assessor ID"
                    >

                </div> --}}


                {{-- Assessment Date --}}

                <div>

                    <label class="block text-sm font-medium">
                        Assessment Date
                    </label>

                    <input type="date" name="assessed_at" value="{{ old('assessed_at', now()->format('Y-m-d')) }}"
                        class="mt-1 block w-full rounded-md border-gray-300">

                </div>


                {{-- Status --}}

                <div>

                    <label class="block text-sm font-medium">
                        Status
                    </label>

                    <select name="status" required class="mt-1 block w-full rounded-md border-gray-300">

                        <option value="Draft" @selected(old('status', 'Draft') === 'Draft')>
                            Draft
                        </option>

                        <option value="Completed" @selected(old('status') === 'Completed')>
                            Completed
                        </option>

                    </select>

                </div>


                {{-- Remarks --}}

                <div>

                    <label class="block text-sm font-medium">
                        Remarks
                    </label>

                    <textarea name="remarks" rows="4" class="mt-1 block w-full rounded-md border-gray-300"
                        placeholder="Assessment remarks...">{{ old('remarks') }}</textarea>

                </div>

            </div>


            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('student-assessments.index') }}" class="rounded-md border px-4 py-2 text-sm">
                    Cancel
                </a>

                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white">
                    Create Assessment
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
