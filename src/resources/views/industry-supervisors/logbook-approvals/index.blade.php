<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Daily Logbook Approvals
            </h2>
        </div>
    </x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Daily Logbook Approvals
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Review submitted daily logbooks from students under your supervision.
        </p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm font-medium text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Pending Review
                    </p>
                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        Daily Logbooks
                    </h3>
                </div>

                <div class="inline-flex items-center gap-2 self-start px-4 py-2 rounded-xl bg-amber-50 border border-amber-100">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span class="text-sm font-semibold text-amber-700">
                        {{ $logbooks->total() }} Pending
                    </span>
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
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Work Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
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
                                <div class="text-sm font-medium text-slate-700">
                                    {{ $logbook->placement?->company?->name ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-700">
                                    {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-slate-700">
                                    {{ $logbook->work_status ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Submitted
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex justify-end">
                                    <a
                                        href="{{ route('industry-supervisor.logbook-approvals.show', $logbook) }}"
                                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                                    >
                                        Review
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <h3 class="mt-4 font-semibold text-slate-700">
                                    No pending logbook approvals
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    There are currently no submitted daily logbooks waiting for review.
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
