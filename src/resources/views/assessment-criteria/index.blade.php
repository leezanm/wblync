<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-6 text-gray-900">
            {{ $assessmentSection->assessmentVersion->assessmentTemplate->code }}
            —
            {{ $assessmentSection->assessmentVersion->name }}
        </h3>
    </x-slot>

    <div class="mx-auto max-w-6xl p-6">

        {{-- Header --}}
        <div class="mb-6 flex items-start justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    {{ $assessmentSection->assessmentVersion->assessmentTemplate->code }}
                    —
                    {{ $assessmentSection->assessmentVersion->name }}
                </p>

                <h1 class="text-2xl font-semibold">
                    {{ $assessmentSection->name }}
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Assessment Criteria
                </p>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route(
                        'assessment-sections.show',
                        [
                            'assessmentTemplate' =>
                                $assessmentSection->assessmentVersion->assessment_template_id,

                            'assessmentVersion' =>
                                $assessmentSection->assessmentVersion->id,

                            'assessmentSection' =>
                                $assessmentSection->id,
                        ]
                    ) }}"
                    class="rounded-md border px-4 py-2 text-sm"
                >
                    Back
                </a>

                @if (! $assessmentSection->assessmentVersion->published_at)

                    <a
                        href="{{ route(
                            'assessment-criteria.create',
                            [
                                'assessmentTemplate' =>
                                    $assessmentSection->assessmentVersion->assessment_template_id,

                                'assessmentVersion' =>
                                    $assessmentSection->assessmentVersion->id,

                                'assessmentSection' =>
                                    $assessmentSection->id,
                            ]
                        ) }}"
                        class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white"
                    >
                        + Add Criteria
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

        @if (session('error'))

            <div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif


        {{-- Criteria Table --}}

        <div class="overflow-hidden rounded-lg border bg-white">

            <table class="min-w-full divide-y">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Order
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Criterion
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Max Score
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Rating Levels
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Required
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-medium uppercase">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @forelse ($criteria as $criterion)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium">
                                {{ $criterion->sort_order }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="font-medium">
                                    {{ $criterion->name }}
                                </div>

                                @if ($criterion->description)

                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ Str::limit($criterion->description, 100) }}
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ number_format((float) $criterion->max_score, 2) }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ $criterion->rating_levels_count }}
                            </td>

                            <td class="px-6 py-4 text-sm">

                                @if ($criterion->is_required)

                                    <span class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">
                                        Required
                                    </span>

                                @else

                                    <span class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-600">
                                        Optional
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-3">

                                    <a
                                        href="{{ route(
                                            'assessment-criteria.show',
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

                                     title="View"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md text-gray-500 transition hover:bg-gray-100 hover:text-gray-700">
                                        <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>


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
                                            class="text-sm text-blue-600 hover:underline"
                                        >
                                            Edit
                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center"
                            >

                                <p class="text-sm text-gray-500">
                                    No assessment criteria found.
                                </p>

                                @if (! $assessmentSection->assessmentVersion->published_at)

                                    <a
                                        href="{{ route(
                                            'assessment-criteria.create',
                                            [
                                                'assessmentTemplate' =>
                                                    $assessmentSection->assessmentVersion->assessment_template_id,

                                                'assessmentVersion' =>
                                                    $assessmentSection->assessmentVersion->id,

                                                'assessmentSection' =>
                                                    $assessmentSection->id,
                                            ]
                                        ) }}"
                                        class="mt-3 inline-block text-sm font-medium text-blue-600 hover:underline"
                                    >
                                        Create the first criterion
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-6">
            {{ $criteria->links() }}
        </div>

    </div>

</x-app-layout>
