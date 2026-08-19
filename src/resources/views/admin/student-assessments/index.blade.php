<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Student Assessments
        </h3>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">

                <h1 class="text-2xl font-semibold text-slate-900">
                    Student Assessments
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    View student assessment submissions by assessment.
                </p>

            </div>


            {{-- Assessment List --}}

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @forelse ($assessmentVersions as $version)

                    @php
                        $template = $version->assessmentTemplate;
                    @endphp

                    <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-lg">

                        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-blue-50 p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="mb-2 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">
                                        {{ $template->course?->code ?? 'Course' }}
                                    </p>
                                    <h2 class="line-clamp-2 text-lg font-semibold text-slate-900">
                                        {{ $template->name }}
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-600">
                                        {{ $template->course?->name }}
                                    </p>
                                </div>

                                <span class="inline-flex shrink-0 items-center rounded-full bg-slate-900 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-white">
                                    V{{ $version->version }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 divide-x divide-slate-100 border-b border-slate-100 bg-slate-50/70">
                            <div class="p-4 text-center">
                                <p class="text-2xl font-bold text-slate-900">
                                    {{ $version->total_students_count }}
                                </p>
                                <p class="mt-1 text-[11px] font-medium uppercase tracking-wide text-slate-500">
                                    Total
                                </p>
                            </div>

                            <div class="p-4 text-center">
                                <p class="text-2xl font-bold text-emerald-600">
                                    {{ $version->submitted_count }}
                                </p>
                                <p class="mt-1 text-[11px] font-medium uppercase tracking-wide text-slate-500">
                                    Submitted
                                </p>
                            </div>

                            <div class="p-4 text-center">
                                <p class="text-2xl font-bold text-amber-600">
                                    {{ $version->draft_count }}
                                </p>
                                <p class="mt-1 text-[11px] font-medium uppercase tracking-wide text-slate-500">
                                    Draft
                                </p>
                            </div>
                        </div>

                        <div class="p-4">
                            <a
                                href="{{ route('admin.student-assessments.students', $version) }}"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Students
                            </a>
                        </div>
                    </div>

                @empty

                    <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75A2.5 2.5 0 1112.25 12.25v1.5M12 17h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500">
                            No student assessments found.
                        </p>
                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}

            @if ($assessmentVersions->hasPages())

                <div class="mt-6">
                    {{ $assessmentVersions->links() }}
                </div>

            @endif

        </div>

    </div>

</x-app-layout>
