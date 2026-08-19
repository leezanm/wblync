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
                </p>

                <h1 class="text-2xl font-semibold">
                    Assessment Sections
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $assessmentVersion->assessmentTemplate->name }}
                    —
                    {{ $assessmentVersion->name }}
                </p>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route(
                        'assessment-versions.show',
                        [
                            $assessmentVersion->assessmentTemplate,
                            $assessmentVersion
                        ]
                    ) }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                >
                    ← Back
                </a>

                <a
                    href="{{ route(
                        'assessment-sections.create',
                        [
                            $assessmentVersion->assessmentTemplate,
                            $assessmentVersion
                        ]
                    ) }}"
                    class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition"
                >
                    + Create Section
                </a>

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


        <div class="overflow-hidden rounded-lg border bg-white">

            <table class="min-w-full divide-y">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Order
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Section
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Criteria
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-medium uppercase">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @forelse ($sections as $section)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium">
                                {{ $section->sort_order }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="font-medium">
                                    {{ $section->name }}
                                </div>

                                @if ($section->description)

                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ Str::limit($section->description, 100) }}
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ $section->criteria_count }}
                            </td>

                            <td class="px-4 py-4">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- View --}}
                                    <a href="{{ route('assessment-sections.show', [$assessmentVersion->assessmentTemplate, $assessmentVersion, $section]) }}"
                                        title="View"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md text-gray-500 transition hover:bg-gray-100 hover:text-gray-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    @if (! $assessmentVersion->published_at)
{{-- can't edit because the assessment version is published --}}
                                        {{-- Edit --}}
                                        <a href="{{ route('assessment-sections.edit', [$assessmentVersion->assessmentTemplate, $assessmentVersion, $section]) }}"
                                            title="Edit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md text-blue-500 transition hover:bg-blue-50 hover:text-blue-700">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-6 py-12 text-center text-sm text-gray-500"
                            >
                                No sections found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-6">
            {{ $sections->links() }}
        </div>

    </div>

</x-app-layout>
