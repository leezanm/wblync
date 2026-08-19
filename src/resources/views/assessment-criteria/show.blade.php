<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-6 text-gray-900">
            {{ $criterion->assessmentSection->assessmentVersion->assessmentTemplate->code }}
            —
            {{ $criterion->assessmentSection->assessmentVersion->name }}
        </h3>
    </x-slot>

    <div class="mx-auto max-w-6xl p-6">

        {{-- Header --}}
        <div class="mb-6 flex items-start justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    {{ $criterion->assessmentSection->assessmentVersion->assessmentTemplate->code }}
                    —
                    {{ $criterion->assessmentSection->assessmentVersion->name }}
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Section: {{ $assessmentSection->name }}
                </p>

                <h1 class="mt-1 text-2xl font-semibold">
                    {{ $criterion->name }}
                </h1>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route(
                        'assessment-criteria.index',
                        [
                            'assessmentTemplate' =>
                                $assessmentSection->assessmentVersion->assessment_template_id,

                            'assessmentVersion' =>
                                $assessmentSection->assessmentVersion->id,

                            'assessmentSection' =>
                                $assessmentSection->id,
                        ]
                    ) }}"
                    class="rounded-md border border-gray-400 px-4 py-2 text-sm"
                >
                    Back
                </a>

                @if (! $assessmentSection->assessmentVersion->published_at)

                    <a
                        href="{{ route(
                            'assessment-criteria.edit',
                            [
                                'assessmentTemplate' =>
                                    $assessmentSection->assessmentVersion->assessment_template_id,

                                'assessmentVersion' =>
                                    $assessmentSection->assessmentVersion->id,

                                'assessmentSection' =>
                                    $assessmentSection->id,

                                'assessmentCriterion' =>
                                    $criterion->id,
                            ]
                        ) }}"
                        class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white"
                    >
                        Edit
                    </a>

                @endif

            </div>

        </div>


        {{-- Flash Messages --}}

        @if (session('success'))

            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- Criterion Details --}}

        <div class="mb-6 rounded-lg border bg-white p-6">

            <div class="grid gap-6 md:grid-cols-3">

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Maximum Score
                    </p>

                    <p class="mt-1 text-lg font-semibold">
                        {{ number_format((float) $criterion->max_score, 2) }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Sort Order
                    </p>

                    <p class="mt-1 text-lg font-semibold">
                        {{ $criterion->sort_order }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Required
                    </p>

                    @if ($criterion->is_required)

                        <span class="mt-1 inline-block rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                            Required
                        </span>

                    @else

                        <span class="mt-1 inline-block rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-600">
                            Optional
                        </span>

                    @endif

                </div>

            </div>

            @if ($criterion->description)

                <div class="mt-6 border-t pt-6">

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Description
                    </p>

                    <p class="mt-2 text-sm leading-6 text-gray-700">
                        {{ $criterion->description }}
                    </p>

                </div>

            @endif

        </div>


        {{-- Rating Levels --}}

        <div class="overflow-hidden rounded-lg border bg-white">

            <div class="flex items-center justify-between border-b px-6 py-4">

                <div>
                    <h2 class="font-semibold">
                        Rating Levels
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Rating scale for this assessment criterion.
                    </p>
                </div>

                @if (! $assessmentSection->assessmentVersion->published_at)

                    <button
                        type="button"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white"
                    >
                        + Add Rating Level
                    </button>

                @endif

            </div>


            <table class="min-w-full divide-y">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Order
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Score
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Level
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Description
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse ($criterion->ratingLevels as $rating)

                        <tr>

                            <td class="px-6 py-4 text-sm">
                                {{ $rating->sort_order }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="font-semibold">
                                    {{ number_format((float) $rating->score, 0) }}
                                </span>

                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $rating->label }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $rating->description }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-6 py-12 text-center text-sm text-gray-500"
                            >
                                No rating levels found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
