<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-6 text-gray-900">
            {{ $assessmentVersion->assessmentTemplate->code }}
            —
            {{ $assessmentVersion->name }}
        </h3>
    </x-slot>

    <div class="mx-auto max-w-6xl p-6">

        <div class="mb-6 flex items-start justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    {{ $assessmentVersion->assessmentTemplate->code }}
                    —
                    {{ $assessmentVersion->name }}
                </p>

                <h1 class="text-2xl font-semibold">
                    {{ $assessmentSection->name }}
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Section {{ $assessmentSection->sort_order }}
                </p>

            </div>


            <div class="flex gap-2">

                <a
                    href="{{ route(
                        'assessment-sections.index',
                        [$assessmentVersion->assessmentTemplate, $assessmentVersion]
                    ) }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                >
                    ← Back
                </a>

                @if (! $assessmentVersion->published_at)

                    <a
                        href="{{ route(
                            'assessment-sections.edit',
                            [
                                $assessmentVersion->assessmentTemplate,
                                $assessmentVersion,
                                $assessmentSection
                            ]
                        ) }}"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition"
                    >
                        Edit
                    </a>

                @endif

            </div>

        </div>


        @if (session('success'))

            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>

        @endif


        @if (session('error'))

            <div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif


        {{-- Section Information --}}
        <div class="mb-6 rounded-lg border bg-white">

            <div class="border-b p-5">

                <h2 class="font-semibold">
                    Section Information
                </h2>

            </div>

            <div class="p-5">

                @if ($assessmentSection->description)

                    <p class="whitespace-pre-line text-sm leading-6 text-gray-600">
                        {{ $assessmentSection->description }}
                    </p>

                @else

                    <p class="text-sm text-gray-400">
                        No description provided.
                    </p>

                @endif

            </div>

        </div>


        {{-- Criteria --}}
        <div class="rounded-lg border bg-white">

            <div class="flex items-center justify-between border-b p-5">

                <div>

                    <h2 class="font-semibold">
                        Assessment Criteria
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $assessmentSection->criteria->count() }}
                        criteria
                    </p>

                </div>


                @if (! $assessmentVersion->published_at)

                    <a
                        href="#"
                        class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white"
                    >
                        + Add Criteria
                    </a>

                @endif

            </div>


            <div class="divide-y">

                @forelse (
                    $assessmentSection->criteria
                    as $criterion
                )

                    <div class="p-5">

                        <div class="flex items-start justify-between">

                            <div>

                                <div class="font-medium">

                                    {{ $criterion->sort_order }}.
                                    {{ $criterion->name }}

                                </div>

                                @if ($criterion->description)

                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $criterion->description }}
                                    </p>

                                @endif

                            </div>


                            <div class="text-right">

                                <div class="text-sm font-medium">
                                    Max:
                                    {{ number_format((float) $criterion->max_score, 2) }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">

                                    @if ($criterion->is_required)
                                        Required
                                    @else
                                        Optional
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="py-12 text-center text-sm text-gray-500">
                        No criteria created yet.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>
