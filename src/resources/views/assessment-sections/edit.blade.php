<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-6 text-gray-900">
            {{ $assessmentVersion->assessmentTemplate->code }}
            —
            {{ $assessmentVersion->name }}
        </h3>
    </x-slot>

    <div class="mx-auto max-w-4xl p-6">

        <div class="mb-6">

            <p class="text-sm text-gray-500">
                {{ $assessmentVersion->assessmentTemplate->code }}
                —
                {{ $assessmentVersion->name }}
            </p>

            <h1 class="text-2xl font-semibold">
                Edit Assessment Section
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $assessmentSection->name }}
            </p>

        </div>


        @if (session('error'))

            <div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif


        <form
            method="POST"
            action="{{ route(
                'assessment-sections.update',
                [
                    $assessmentVersion->assessmentTemplate,
                    $assessmentVersion,
                    $assessmentSection
                ]
            ) }}"
            class="rounded-lg border bg-white"
        >

            @csrf
            @method('PUT')

            <div class="space-y-6 p-6">

                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Section Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old(
                            'name',
                            $assessmentSection->name
                        ) }}"
                        required
                        class="w-full rounded-md border-gray-300"
                    >

                    @error('name')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-md border-gray-300"
                    >{{ old(
                        'description',
                        $assessmentSection->description
                    ) }}</textarea>

                    @error('description')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old(
                            'sort_order',
                            $assessmentSection->sort_order
                        ) }}"
                        min="1"
                        required
                        class="w-full rounded-md border-gray-300"
                    >

                    @error('sort_order')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            <div class="flex justify-end gap-3 border-t bg-gray-50 p-5">

                <a
                    href="{{ route(
                        'assessment-sections.show',
                        [
                            $assessmentVersion->assessmentTemplate,
                            $assessmentVersion,
                            $assessmentSection
                        ]
                    ) }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700 transition"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
