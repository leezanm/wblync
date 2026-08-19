<x-app-layout>

    <div class="mx-auto max-w-4xl p-6">

        <div class="mb-6">

            <p class="text-sm text-gray-500">
                {{ $assessmentTemplate->code }}
            </p>

            <h1 class="text-2xl font-semibold">
                Create Assessment Version
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $assessmentTemplate->name }}
            </p>

        </div>


        <form
            method="POST"
            action="{{ route('assessment-versions.store', $assessmentTemplate) }}"
            class="rounded-lg border bg-white"
        >

            @csrf

            <div class="space-y-6 p-6">

                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Version
                    </label>

                    <input
                        type="number"
                        name="version"
                        value="{{ old('version', $nextVersion) }}"
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
                        value="{{ old('name', 'Version ' . $nextVersion) }}"
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
                        placeholder="Enter instructions for the Industry Mentor..."
                    >{{ old('instructions') }}</textarea>

                    @error('instructions')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Maximum Score
                    </label>

                    <input
                        type="number"
                        name="max_score"
                        value="{{ old('max_score', 0) }}"
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
                            checked
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
                    href="{{ route('assessment-versions.index', $assessmentTemplate) }}"
                    class="rounded-md border px-4 py-2 text-sm"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-md bg-gray-900 px-5 py-2 text-sm font-medium text-white"
                >
                    Create Version
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
