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
                List of Programmes
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Manage programme records for WBLync.
            </p>
        </div>

        <a
            href="{{ route('programmes.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 shadow-sm"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14" />
            </svg>
            Add Programme
        </a>
    </div>

    @if (session('success'))
        <div class="mt-6 rounded-xl border px-4 py-4 text-sm font-medium" style="border-color: #bbf7d0; background-color: #f0fdf4; color: #166534;">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" action="{{ route('programmes.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_auto_auto]">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 11-13.5 0 6.75 6.75 0 0113.5 0z" />
                </svg>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search programme code or name..."
                    class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-10 pr-4 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <select name="status" class="rounded-xl border-slate-200 bg-slate-50 py-3 focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Status</option>
                <option value="1" @selected(request('status') === '1')>Active</option>
                <option value="0" @selected(request('status') === '0')>Inactive</option>
            </select>

            <div class="flex gap-2">
                <button class="flex-1 rounded-xl bg-slate-800 px-5 py-3 font-medium text-white hover:bg-slate-900">
                    Filter
                </button>

                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('programmes.index') }}" class="rounded-xl border border-slate-200 px-4 py-3 text-slate-600 hover:bg-slate-50">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm md:block">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Code</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Programme</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Duration</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($programmes as $programme)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($programmes->currentPage() - 1) * $programmes->perPage() }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-blue-600">{{ $programme->code }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $programme->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-sm font-semibold text-slate-700">
                                    {{ $programme->duration ? $programme->duration . ' yr' : '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($programme->status)
                                    <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('programmes.show', $programme) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-blue-50 hover:text-blue-600" title="View">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z" />
                                            <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.8" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('programmes.edit', $programme) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-amber-50 hover:text-amber-600" title="Edit">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20h4l10.5-10.5a2.1 2.1 0 00-3-3L5 17v3z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('programmes.destroy', $programme) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this programme?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-red-50 hover:text-red-600" title="Delete">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M10 11v6M14 11v6M9 7V4h6v3M6 7l1 14h10l1-14" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <h3 class="font-semibold text-slate-700">No programmes found</h3>
                                <p class="mt-1 text-sm text-slate-500">Create your first programme to get started.</p>
                                <a href="{{ route('programmes.create') }}" class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Add New Programme</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm md:hidden">
        @forelse ($programmes as $programme)
            <div class="border-b border-slate-100 p-5 last:border-0">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <span class="text-sm font-bold text-blue-600">{{ $programme->code }}</span>
                        <h3 class="mt-1 font-semibold text-slate-800">{{ $programme->name }}</h3>
                    </div>

                    @if ($programme->status)
                        <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">Active</span>
                    @else
                        <span class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">Inactive</span>
                    @endif
                </div>

                <div class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Duration</span>
                        <span class="font-medium text-slate-700">{{ $programme->duration ? $programme->duration . ' year(s)' : '-' }}</span>
                    </div>
                </div>

                <div class="mt-5 flex items-center justify-end gap-2">
                    <a href="{{ route('programmes.show', $programme) }}" class="rounded-lg bg-blue-50 px-3 py-2 text-sm text-blue-600">View</a>
                    <a href="{{ route('programmes.edit', $programme) }}" class="rounded-lg bg-amber-50 px-3 py-2 text-sm text-amber-600">Edit</a>
                    <form action="{{ route('programmes.destroy', $programme) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this programme?');">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-lg bg-red-50 px-3 py-2 text-sm text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-10 text-center">
                <h3 class="font-semibold text-slate-700">No programmes found</h3>
                <p class="mt-1 text-sm text-slate-500">Create your first programme.</p>
                <a href="{{ route('programmes.create') }}" class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Add New Programme</a>
            </div>
        @endforelse
    </div>

    @if ($programmes->hasPages())
        <div class="mt-6">
            {{ $programmes->withQueryString()->links() }}
        </div>
    @endif

</x-app-layout>
