<x-app-layout>

    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Assessment Templates
        </h3>
    </x-slot>

    <div class="p-6">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold">
                    Assessment Templates
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Manage assessment templates for each course.
                </p>
            </div>

            <a href="{{ route('assessment-templates.create') }}"
                class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800">
                + Create Assessment
            </a>

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Validation Error --}}
        @if ($errors->any())

            <div class="mb-6 rounded-md bg-red-50 p-4">

                <ul class="list-disc pl-5 text-sm text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Desktop Table (md and above) --}}
        <div class="hidden overflow-x-auto rounded-lg border bg-white md:block">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider flex-wrap text-gray-500">Assessment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Assessor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse ($assessmentTemplates as $template)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $template->course?->code }}</div>
                                <div class="text-sm text-gray-500">{{ $template->course?->name }}</div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">{{ $template->code }}</td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $template->name }}</div>
                                @if ($template->description)
                                    <div class="mt-1 max-w-xs break-words text-sm text-gray-500">{{ $template->description }}</div>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                @if ($template->assessor_type === 'INDUSTRY_MENTOR') Industry Mentor
                                @elseif ($template->assessor_type === 'LECTURER') Lecturer
                                @else {{ $template->assessor_type }} @endif
                            </td>

                            <td class="px-6 py-4">
                                @if ($template->status)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Active</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">Inactive</span>
                                @endif
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center justify-end gap-1">

                                    <a href="{{ route('assessment-templates.show', $template) }}" title="View"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md text-blue-500 transition hover:bg-gray-100 hover:text-gray-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    <a href="{{ route('assessment-templates.edit', $template) }}" title="Edit"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md text-yellow-500 transition hover:bg-yellow-50 hover:text-yellow-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    @if ($template->status)
                                        <form method="POST" action="{{ route('assessment-templates.destroy', $template) }}"
                                            onsubmit="return confirm('Deactivate this assessment template?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" title="Deactivate"
                                                class="inline-flex text-red-500 h-8 w-8 items-center  justify-center rounded-md text-red-400 transition hover:bg-red-50 hover:text-red-600">
                                                <svg class="h-4 w-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">
                                No assessment templates found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Mobile Card List (below md) --}}
        <div class="space-y-3 md:hidden">

            @forelse ($assessmentTemplates as $template)

                <div class="rounded-lg border bg-white p-4 shadow-sm">

                    {{-- Top row: course + status --}}
                    <div class="mb-2 flex items-start justify-between gap-2">

                        <div>
                            <div class="text-xs font-medium text-gray-500">{{ $template->course?->code }}</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $template->name }}</div>
                            <div class="mt-0.5 text-xs text-gray-500">{{ $template->code }}</div>
                        </div>

                        @if ($template->status)
                            <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Active</span>
                        @else
                            <span class="shrink-0 rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">Inactive</span>
                        @endif

                    </div>

                    {{-- Assessor --}}
                    <div class="mb-3 text-xs text-gray-500">
                        Assessor:
                        @if ($template->assessor_type === 'INDUSTRY_MENTOR') Industry Mentor
                        @elseif ($template->assessor_type === 'LECTURER') Lecturer
                        @else {{ $template->assessor_type }} @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 border-t pt-3">

                        <a href="{{ route('assessment-templates.show', $template) }}"
                            class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-md border border-gray-200 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </a>

                        <a href="{{ route('assessment-templates.edit', $template) }}"
                            class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-md border border-blue-200 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit
                        </a>

                        @if ($template->status)
                            <form method="POST" action="{{ route('assessment-templates.destroy', $template) }}"
                                onsubmit="return confirm('Deactivate this assessment template?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-md border border-red-200 px-3 py-1.5 text-xs font-medium text-red-500 hover:bg-red-50 transition">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    Off
                                </button>
                            </form>
                        @endif

                    </div>

                </div>

            @empty

                <div class="rounded-lg border bg-white p-8 text-center text-sm text-gray-500">
                    No assessment templates found.
                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        <div class="mt-6">
            {{ $assessmentTemplates->links() }}
        </div>

    </div>

</x-app-layout>
