<x-app-layout>

    <div class="mx-auto max-w-4xl p-6">

        <div class="mb-6">

            <p class="text-sm text-gray-500">
                {{ $assessmentTemplate->code }}
            </p>

            <h1 class="text-2xl font-semibold">
                Edit Assessment Version
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Version {{ $assessmentVersion->version }}
                — {{ $assessmentVersion->name }}
            </p>

        </div>


        @if (session('error'))

            <div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif


        <form
            method="POST"
            action="{{ route('assessment-versions.update', [$assessmentTemplate, $assessmentVersion]) }}"
            class="rounded-lg border bg-white"
        >

            @csrf
            @method('PUT')

            <div class="space-y-6 p-6">

                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Version
                    </label>

                    <input
                        type="number"
                        name="version"
                        value="{{ old('version', $assessmentVersion->version) }}"
                        min="1"
                        required
                        class="w-full rounded-md border-gray-300"
                    >

                    @error('version')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Version Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $assessmentVersion->name) }}"
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
                        Instructions
                    </label>

                    <textarea
                        name="instructions"
                        rows="6"
                        class="w-full rounded-md border-gray-300"
                    >{{ old('instructions', $assessmentVersion->instructions) }}</textarea>

                </div>


                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Maximum Score
                    </label>

                    <input
                        type="number"
                        name="max_score"
                        value="{{ old('max_score', $assessmentVersion->max_score) }}"
                        min="0"
                        step="0.01"
                        required
                        class="w-full rounded-md border-gray-300"
                    >

                    @error('max_score')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            @checked(old('status', $assessmentVersion->status))
                            class="rounded border-gray-300"
                        >

                        <span class="text-sm font-medium">
                            Active
                        </span>

                    </label>

                </div>

            </div>


            <div class="flex justify-end gap-3 border-t bg-gray-50 p-5">

                <a
                    href="{{ route('assessment-versions.show', [$assessmentTemplate, $assessmentVersion]) }}"
                    class="rounded-md border px-4 py-2 text-sm"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-md bg-gray-900 px-5 py-2 text-sm font-medium text-white"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
