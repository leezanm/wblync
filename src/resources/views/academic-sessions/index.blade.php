<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Academic Sessions
            </h2>
        </div>

    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                List of Academic Sessions
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Manage academic sessions for WBLync.
            </p>
        </div>

        <a
            href="{{ route('academic-sessions.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 shadow-sm"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14" />
            </svg>
            Add Academic Session
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 mt-6 flex items-start gap-3 rounded-xl border px-4 py-4 text-sm font-medium" style="border-color: #bbf7d0; background-color: #f0fdf4; color: #166534;">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 mt-6 flex items-start gap-3 rounded-xl border px-4 py-4 text-sm font-medium" style="border-color: #fecaca; background-color: #fef2f2; color: #991b1b;">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M5.07 19h13.86A2.07 2.07 0 0020.7 16L13.77 4a2.07 2.07 0 00-3.54 0L3.3 16A2.07 2.07 0 005.07 19z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="mb-6 mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" action="{{ route('academic-sessions.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_auto]">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 11-13.5 0 6.75 6.75 0 0113.5 0z" />
                </svg>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search academic session code or name..."
                    class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-10 pr-4 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 rounded-xl bg-slate-800 px-5 py-3 font-medium text-white transition hover:bg-slate-900">
                    Filter
                </button>

                @if (request()->filled('search'))
                    <a href="{{ route('academic-sessions.index') }}" class="rounded-xl border border-slate-200 px-4 py-3 text-slate-600 transition hover:bg-slate-50">
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
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Academic Session</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Date Range</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Current</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($sessions as $session)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($sessions->currentPage() - 1) * $sessions->perPage() }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-blue-600">{{ $session->code }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $session->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $session->start_date?->format('d/m/Y') ?? '-' }} - {{ $session->end_date?->format('d/m/Y') ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($session->status === 'Active')
                                    <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                        Active
                                    </span>
                                @elseif ($session->status === 'Draft')
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1.5 text-xs font-semibold text-yellow-700">
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                                        Closed
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($session->current)
                                    <span class="text-green-600">✔</span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('academic-sessions.edit', $session) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-amber-50 hover:text-amber-600" title="Edit">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20h4l10.5-10.5a2.1 2.1 0 00-3-3L5 17v3z" />
                                        </svg>
                                    </a>

                                    <form method="POST" action="{{ route('academic-sessions.destroy', $session) }}" onsubmit="return confirm('Are you sure you want to delete this academic session?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-red-50 hover:text-red-600" title="Delete">
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
                            <td colspan="7" class="px-6 py-16 text-center">
                                <h3 class="font-semibold text-slate-700">No academic sessions found</h3>
                                <p class="mt-1 text-sm text-slate-500">Create your first academic session to get started.</p>
                                <a href="{{ route('academic-sessions.create') }}" class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                                    Add Academic Session
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm md:hidden">
        @forelse ($sessions as $session)
            <div class="border-b border-slate-100 p-5 last:border-0">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <span class="text-sm font-bold text-blue-600">{{ $session->code }}</span>
                        <h3 class="mt-1 font-semibold text-slate-800">{{ $session->name }}</h3>
                    </div>

                    @if ($session->status === 'Active')
                        <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">Active</span>
                    @elseif ($session->status === 'Draft')
                        <span class="shrink-0 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-700">Draft</span>
                    @else
                        <span class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">Closed</span>
                    @endif
                </div>

                <div class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Date Range</span>
                        <span class="text-right font-medium text-slate-700">
                            {{ $session->start_date?->format('d/m/Y') ?? '-' }} - {{ $session->end_date?->format('d/m/Y') ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Current</span>
                        <span class="font-medium text-slate-700">{{ $session->current ? 'Yes' : 'No' }}</span>
                    </div>
                </div>

                <div class="mt-5 flex items-center justify-end gap-2">
                    <a href="{{ route('academic-sessions.edit', $session) }}" class="rounded-lg bg-amber-50 px-3 py-2 text-sm text-amber-600">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('academic-sessions.destroy', $session) }}" onsubmit="return confirm('Are you sure you want to delete this academic session?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="rounded-lg bg-red-50 px-3 py-2 text-sm text-red-600">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-10 text-center">
                <h3 class="font-semibold text-slate-700">No academic sessions found</h3>
                <p class="mt-1 text-sm text-slate-500">Create your first academic session.</p>
                <a href="{{ route('academic-sessions.create') }}" class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Add Academic Session
                </a>
            </div>
        @endforelse
    </div>

    @if ($sessions->hasPages())
        <div class="mt-6">
            {{ $sessions->withQueryString()->links() }}
        </div>
    @endif

</x-app-layout>
