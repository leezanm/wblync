<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Programmes
            </h2>
        </div>
    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Programme Details
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                View the selected programme information.
            </p>
        </div>

        <a
            href="{{ route('programmes.edit', $programme) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
        >
            Edit Programme
        </a>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-5xl">
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <p class="text-sm text-slate-500">Code</p>
                        <p class="mt-1 text-lg font-semibold text-slate-800">{{ $programme->code }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Status</p>
                        <p class="mt-1 text-lg font-semibold text-slate-800">
                            {{ $programme->status ? 'Active' : 'Inactive' }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-slate-500">Programme Name</p>
                        <p class="mt-1 text-lg font-semibold text-slate-800">{{ $programme->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Duration</p>
                        <p class="mt-1 text-lg font-semibold text-slate-800">{{ $programme->duration ? $programme->duration . ' year(s)' : '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-slate-500">Description</p>
                        <p class="mt-1 text-slate-700">{{ $programme->description ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <a href="{{ route('programmes.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                        ← Back to Programmes
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
