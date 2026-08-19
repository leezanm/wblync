<x-app-layout>

    <div class="mx-auto max-w-4xl p-6">

        <div class="mb-6">
            <p class="text-sm text-gray-500">
                {{ $criterion->name }}
            </p>

            <h1 class="text-2xl font-semibold">
                Add Rating Level
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Maximum score:
                {{ number_format((float) $criterion->max_score, 2) }}
            </p>
        </div>

        <form
            method="POST"
            action="{{ route(
                'assessment-rating-levels.store',
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
            class="rounded-lg border bg-white p-6"
        >

            @csrf

            <div class="space-y-6">

                <div>
                    <label class="block text-sm font-medium">
                        Score
                    </label>

                    <input
                        type="number"
                        name="score"
                        value="{{ old('score') }}"
                        min="0"
                        max="{{ $criterion->max_score }}"
                        step="0.01"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300"
                    >

                    @error('score')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div>
                    <label class="block text-sm font-medium">
                        Label
                    </label>

                    <input
                        type="text"
                        name="label"
                        value="{{ old('label') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300"
                        placeholder="e.g. Excellent"
                    >

                    @error('label')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div>
                    <label class="block text-sm font-medium">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300"
                        placeholder="Describe the expected performance..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div>
                    <label class="block text-sm font-medium">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $nextSortOrder) }}"
                        min="1"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300"
                    >

                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>


            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route(
                        'assessment-rating-levels.index',
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
                    class="rounded-md border px-4 py-2 text-sm"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white"
                >
                    Save Rating Level
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
