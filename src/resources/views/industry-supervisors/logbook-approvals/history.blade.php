<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Daily Logbook Approval History
            </h2>
        </div>
    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Daily Logbook Approval History
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                View daily logbooks that you have approved or rejected.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Previous Reviews
                    </p>
                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        Approval History
                    </h3>
                </div>
                <div class="px-4 py-2 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold">
                    {{ $logbooks->total() }} Records
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Student</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Company</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Reviewed</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Decision</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($logbooks as $logbook)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-5">
                                <div class="font-semibold text-slate-800">
                                    {{ $logbook->placement?->student?->name ?? '-' }}
                                </div>
                                <div class="text-sm text-slate-500 mt-1">
                                    {{ $logbook->placement?->student?->student_no ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="text-sm text-slate-700">
                                    {{ $logbook->placement?->company?->name ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-700">
                                    {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-slate-700">
                                    {{ $logbook->updated_at?->format('d M Y') ?? '-' }}
                                </div>
                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $logbook->updated_at?->format('h:i A') ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                @if ($logbook->status === 'Approved')
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        Approved
                                    </span>
                                @elseif ($logbook->status === 'Rejected')
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        Rejected
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex justify-end">
                                    <a
                                        href="{{ route('industry-supervisor.logbook-approvals.show', $logbook) }}"
                                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
                                    >
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <h3 class="mt-4 font-semibold text-slate-700">
                                    No approval history
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    You have not approved or rejected any daily logbooks yet.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($logbooks->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $logbooks->links() }}
            </div>
        @endif
    </div>

</x-app-layout>
