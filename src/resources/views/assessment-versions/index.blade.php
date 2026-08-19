<x-app-layout>

    <div class="mx-auto max-w-6xl p-6">

        <div class="mb-6 flex items-start justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    {{ $assessmentTemplate->code }}
                </p>

                <h1 class="text-2xl font-semibold">
                    Assessment Versions
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $assessmentTemplate->name }}
                </p>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route('assessment-templates.show', $assessmentTemplate) }}"
                    class="rounded-md border border-gray-400 px-4 py-2 text-sm"
                >
                    Back
                </a>

                <a
                    href="{{ route('assessment-versions.create', $assessmentTemplate) }}"
                    class="rounded-md bg-blue-600 hover:bg-blue-700 px-4 py-2 text-sm font-medium text-white"
                >
                    + Create Version
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
                            Version
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Name
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Max Score
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Status
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            Published
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-medium uppercase">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @forelse ($versions as $version)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium">
                                Version {{ $version->version }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ $version->name }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ number_format((float) $version->max_score, 2) }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($version->status)

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-sm">

                                @if ($version->published_at)

                                    {{ $version->published_at->format('d/m/Y H:i') }}

                                @else

                                    <span class="text-gray-400">
                                        Not Published
                                    </span>

                                @endif

                            </td>


                            <td class="px-4 py-4">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- View --}}
                                    <a href="{{ route('assessment-versions.show', [$assessmentTemplate, $version]) }}"
                                        title="View"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md text-gray-500 transition hover:bg-gray-100 hover:text-gray-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    @if (! $version->published_at)

                                        {{-- Edit --}}
                                        <a href="{{ route('assessment-versions.edit', [$assessmentTemplate, $version]) }}"
                                            title="Edit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md text-blue-500 transition hover:bg-blue-50 hover:text-blue-700">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        {{-- Publish --}}
                                        <form method="POST"
                                            action="{{ route('assessment-versions.publish', [$assessmentTemplate, $version]) }}"
                                            onsubmit="return confirm('Publish this assessment version?')">
                                            @csrf
                                            <button type="submit" title="Publish"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md text-green-500 transition hover:bg-green-50 hover:text-green-700">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </button>
                                        </form>

                                    @else

                                        {{-- Unpublish --}}
                                        <form method="POST"
                                            action="{{ route('assessment-versions.unpublish', [$assessmentTemplate, $version]) }}"
                                            onsubmit="return confirm('Unpublish this assessment version?')">
                                            @csrf
                                            <button type="submit" title="Unpublish"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md text-red-400 transition hover:bg-red-50 hover:text-red-600">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                </svg>
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center text-sm text-gray-500"
                            >
                                No assessment versions found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-6">
            {{ $versions->links() }}
        </div>

    </div>

</x-app-layout>
