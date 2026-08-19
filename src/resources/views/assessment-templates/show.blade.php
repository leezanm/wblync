<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Assessment Template Details
        </h3>
    </x-slot>
    <div class="mx-auto max-w-6xl p-6">

        {{-- Header --}}
        <div class="mb-6 flex items-start justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    {{ $assessmentTemplate->code }}
                </p>

                <h1 class="text-2xl font-semibold">
                    {{ $assessmentTemplate->name }}
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $assessmentTemplate->course?->code }}
                    -
                    {{ $assessmentTemplate->course?->name }}
                </p>

            </div>


            <div class="flex gap-2">

                <a href="{{ route('assessment-templates.index') }}"
                    class="rounded-md border border-gray-400 px-4 py-2 text-sm">
                    Back
                </a>

                <a href="{{ route('assessment-templates.edit', $assessmentTemplate) }}"
                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                    Edit
                </a>

            </div>

        </div>


        {{-- Success --}}
        @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Template Details --}}
        <div class="mb-6 rounded-lg border bg-white">

            <div class="border-b p-5">

                <h2 class="font-semibold">
                    Assessment Information
                </h2>

            </div>


            <div class="grid gap-6 p-5 md:grid-cols-2 lg:grid-cols-4">

                <div>

                    <div class="text-xs text-gray-500">
                        Course
                    </div>

                    <div class="mt-1 font-medium">
                        {{ $assessmentTemplate->course?->code }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $assessmentTemplate->course?->name }}
                    </div>

                </div>


                <div>

                    <div class="text-xs text-gray-500">
                        Assessment Code
                    </div>

                    <div class="mt-1 font-medium">
                        {{ $assessmentTemplate->code }}
                    </div>

                </div>


                <div>

                    <div class="text-xs text-gray-500">
                        Assessor
                    </div>

                    <div class="mt-1 font-medium">
                        Industry Mentor
                    </div>

                </div>


                <div>

                    <div class="text-xs text-gray-500">
                        Status
                    </div>

                    <div class="mt-1">

                        @if ($assessmentTemplate->status)
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                Active
                            </span>
                        @else
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                Inactive
                            </span>
                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Description --}}
        @if ($assessmentTemplate->description)
            <div class="mb-6 rounded-lg border bg-white p-5">

                <h2 class="mb-2 font-semibold">
                    Description
                </h2>

                <p class="text-sm leading-6 text-gray-600">
                    {{ $assessmentTemplate->description }}
                </p>

            </div>
        @endif


        {{-- Versions --}}
        <div class="rounded-lg border bg-white">

            <div class="flex items-center justify-between border-b p-5">

                <div>
                    <h2 class="font-semibold">
                        Assessment Versions
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage versions of this assessment.
                    </p>
                </div>

                <a href="{{ route('assessment-versions.index', $assessmentTemplate) }}"
                    class="rounded-md bg-gray-600 hover:bg-gray-700 px-4 py-2 text-sm font-medium text-white">
                    Manage Versions
                </a>

            </div>


            <div class="p-5">

                @if ($assessmentTemplate->versions->count())

                    <div class="space-y-3">

                        @foreach ($assessmentTemplate->versions as $version)
                            <div class="rounded-md border p-4">

                                <div class="flex justify-between">

                                    <div>

                                        <div class="font-medium">
                                            Version {{ $version->version }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ $version->name }}
                                        </div>

                                    </div>

                                    <div class="text-sm text-gray-500">
                                        Max Score:
                                        {{ $version->max_score }}
                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="py-8 text-center text-sm text-gray-500">
                        No assessment version has been created yet.
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
