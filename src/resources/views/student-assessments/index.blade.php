<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Student Assessments
        </h3>
    </x-slot>

    <div class="mx-auto max-w-7xl p-6">

        <h1 class="text-2xl font-semibold">
            Student Assessments
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            {{ $assessments->total() }} assessment(s) found.
        </p>

        @forelse ($assessments as $assessment)

            <div class="mt-4 rounded-lg border bg-white p-4">

                <div class="font-medium">
                    {{ $assessment->student->name ?? '-' }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ $assessment->assessmentVersion->assessmentTemplate->name ?? '-' }}
                </div>

            </div>

        @empty

            <div class="mt-6 rounded-lg border bg-white p-8 text-center">

                <p class="text-sm text-gray-500">
                    No student assessments found.
                </p>

            </div>

        @endforelse

    </div>

</x-app-layout>
