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
                    Criterion
                </p>

                <h1 class="text-2xl font-semibold">
                    {{ $criterion->name }}
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Rating Levels
                </p>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route(
                        'assessment-criteria.show',
                        [
                            'assessmentTemplate' =>
                                $criterion->assessmentSection->assessmentVersion->assessment_template_id,

                            'assessmentVersion' =>
                                $criterion->assessmentSection->assessmentVersion->id,

                            'assessmentSection' =>
                                $criterion->assessmentSection->id,

                            'assessmentCriterion' =>
                                $criterion->id,
                        ]
                    ) }}"
                    class="rounded-md border border-gray-400 px-4 py-2 text-sm"
                >
                    Back
                </a>

                {{-- @if (! $criterion->assessmentSection->assessmentVersion->published_at) --}}
@if ($criterion->assessmentSection->assessmentVersion->status)
                    <a
                        href="{{ route(
                            'assessment-rating-levels.create',
                            [
                                'assessmentTemplate' =>
                                    $criterion->assessmentSection->assessmentVersion->assessment_template_id,

                                'assessmentVersion' =>
                                    $criterion->assessmentSection->assessmentVersion->id,

                                'assessmentSection' =>
                                    $criterion->assessmentSection->id,

                                'assessmentCriterion' =>
                                    $criterion->id,
                            ]
                        ) }}"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white"
                    >
                        + Add Rating Level
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


        {{-- Criterion Summary --}}

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

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Rating Levels
                    </p>

                    <p class="mt-1 text-lg font-semibold">
                        {{ $criterion->ratingLevels->count() }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Rating Levels Table --}}

        <div class="overflow-hidden rounded-lg border bg-white">

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

                        <th class="px-6 py-3 text-right text-xs font-medium uppercase">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @forelse ($criterion->ratingLevels as $rating)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium">
                                {{ $rating->sort_order }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="rounded-full bg-gray-100 px-3 py-1 text-sm font-semibold">
                                    {{ number_format((float) $rating->score, 0) }}
                                </span>

                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $rating->label }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $rating->description }}
                            </td>

                            <td class="px-6 py-4">

                                @if (! $criterion->assessmentSection->assessmentVersion->published_at)

                                    <div class="flex items-center justify-end gap-1">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route(
                                                'assessment-rating-levels.edit',
                                                [
                                                    'assessmentTemplate' =>
                                                        $criterion->assessmentSection->assessmentVersion->assessment_template_id,
                                                    'assessmentVersion' =>
                                                        $criterion->assessmentSection->assessmentVersion->id,
                                                    'assessmentSection' =>
                                                        $criterion->assessmentSection->id,
                                                    'assessmentCriterion' =>
                                                        $criterion->id,
                                                    'assessmentRatingLevel' =>
                                                        $rating->id,
                                                ]
                                            ) }}"
                                            title="Edit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md text-blue-500 transition hover:bg-blue-50 hover:text-blue-700"
                                        >
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'assessment-rating-levels.destroy',
                                                [
                                                    'assessmentTemplate' =>
                                                        $criterion->assessmentSection->assessmentVersion->assessment_template_id,
                                                    'assessmentVersion' =>
                                                        $criterion->assessmentSection->assessmentVersion->id,
                                                    'assessmentSection' =>
                                                        $criterion->assessmentSection->id,
                                                    'assessmentCriterion' =>
                                                        $criterion->id,
                                                    'assessmentRatingLevel' =>
                                                        $rating->id,
                                                ]
                                            ) }}"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                onclick="return confirm('Delete this rating level?')"
                                                title="Delete"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md text-red-400 transition hover:bg-red-50 hover:text-red-600"
                                            >
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>

                                        </form>

                                    </div>

                                @else

                                    <span class="inline-flex items-center gap-1 text-xs text-gray-400">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-12 text-center"
                            >

                                <p class="text-sm text-gray-500">
                                    No rating levels found.
                                </p>

                                @if (! $criterion->assessmentSection->assessmentVersion->published_at)

                                    <a
                                        href="{{ route(
                                            'assessment-rating-levels.create',
                                            [
                                                'assessmentTemplate' =>
                                                    $criterion->assessmentSection->assessmentVersion->assessment_template_id,

                                                'assessmentVersion' =>
                                                    $criterion->assessmentSection->assessmentVersion->id,

                                                'assessmentSection' =>
                                                    $criterion->assessmentSection->id,

                                                'assessmentCriterion' =>
                                                    $criterion->id,
                                            ]
                                        ) }}"
                                        class="mt-3 inline-block text-sm font-medium text-blue-600 hover:underline"
                                    >
                                        Create the first rating level
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
