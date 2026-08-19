<x-app-layout>

    <div class="mx-auto max-w-6xl p-6">

        <div class="mb-6 flex items-start justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    {{ $assessmentTemplate->code }}
                </p>

                <h1 class="text-2xl font-semibold">
                    Version {{ $assessmentVersion->version }}
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $assessmentVersion->name }}
                </p>

            </div>


            <div class="flex gap-2">

                <a
                    href="{{ route('assessment-versions.index', $assessmentTemplate) }}"
                    class="rounded-md border border-gray-400 px-4 py-2 text-sm"
                >
                    Back
                </a>

                @if (! $assessmentVersion->published_at)

                    <a
                        href="{{ route('assessment-versions.edit', [$assessmentTemplate, $assessmentVersion]) }}"
                        class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white"
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


        {{-- Version Information --}}
        <div class="mb-6 rounded-lg border bg-white">

            <div class="border-b p-5">

                <h2 class="font-semibold">
                    Version Information
                </h2>

            </div>


            <div class="grid gap-6 p-5 md:grid-cols-4">

                <div>

                    <div class="text-xs text-gray-500">
                        Version
                    </div>

                    <div class="mt-1 font-medium">
                        {{ $assessmentVersion->version }}
                    </div>

                </div>


                <div>

                    <div class="text-xs text-gray-500">
                        Maximum Score
                    </div>

                    <div class="mt-1 font-medium">
                        {{ number_format((float) $assessmentVersion->max_score, 2) }}
                    </div>

                </div>


                <div>

                    <div class="text-xs text-gray-500">
                        Status
                    </div>

                    <div class="mt-1">

                        @if ($assessmentVersion->status)

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


                <div>

                    <div class="text-xs text-gray-500">
                        Published
                    </div>

                    <div class="mt-1 text-sm">

                        @if ($assessmentVersion->published_at)

                            {{ $assessmentVersion->published_at->format('d/m/Y H:i') }}

                        @else

                            Not Published

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Instructions --}}
        <div class="mb-6 rounded-lg border bg-white p-5">

            <h2 class="mb-3 font-semibold">
                Instructions
            </h2>

            @if ($assessmentVersion->instructions)

                <p class="whitespace-pre-line text-sm leading-6 text-gray-600">
                    {{ $assessmentVersion->instructions }}
                </p>

            @else

                <p class="text-sm text-gray-400">
                    No instructions provided.
                </p>

            @endif

        </div>


        {{-- Sections --}}
        <div class="rounded-lg border bg-white">

            <div class="flex items-center justify-between border-b p-5">

                <div>

                    <h2 class="font-semibold">
                        Assessment Sections
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Sections and criteria will be managed next.
                    </p>

                </div>

            </div>


            <div class="p-5">

                @if ($assessmentVersion->sections->count())

                    <div class="space-y-4">

                        @foreach ($assessmentVersion->sections as $section)

                            <div class="rounded-md border p-4">

                                <div class="font-medium">
                                    {{ $section->sort_order }}.
                                    {{ $section->name }}
                                </div>

                                @if ($section->description)

                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $section->description }}
                                    </p>

                                @endif

                                <div class="mt-3 text-sm text-gray-500">
                                    {{ $section->criteria->count() }}
                                    criteria
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="py-8 text-center text-sm text-gray-500">
                        No sections created yet.
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
