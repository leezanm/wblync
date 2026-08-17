<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    Daily Logbooks
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Read-only daily logbook records for this student.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-slate-800 mt-1">
                {{ $student->name }}
            </h3>
            <p class="text-sm text-slate-500 mt-1">
                Student No: {{ $student->student_no ?? '-' }}
            </p>
        </div>

        <a
            href="{{ route('lecturer.students.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
        >
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M15 19l-7-7 7-7"
                />
            </svg>
            Back to My Students
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Logbook Records
                    </p>
                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        Daily Entries
                    </h3>
                </div>
                <div class="px-4 py-2 rounded-xl bg-blue-50 text-blue-700 text-sm font-semibold">
                    {{ $logbooks->total() }} Records
                </div>
            </div>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse ($logbooks as $logbook)
                <div class="p-6 hover:bg-slate-50 transition">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-5">
                        <div class="lg:w-48 shrink-0">
                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                Date
                            </p>
                            <p class="text-lg font-bold text-slate-800 mt-1">
                                {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $logbook->log_date?->format('l') ?? '-' }}
                            </p>
                        </div>

                        <div class="flex-1">
                            <p class="font-semibold text-slate-700">
                                {{ $logbook->placement?->company?->name ?? '-' }}
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $logbook->work_status ?? 'No work status' }}
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $logbook->working_hours ?? '-' }} hours
                            </p>
                        </div>

                        <div class="shrink-0 flex items-center gap-3">
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold
                                {{ $logbook->status === 'Submitted' ? 'bg-amber-100 text-amber-700' : '' }}
                                {{ $logbook->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $logbook->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $logbook->status === 'Draft' ? 'bg-slate-100 text-slate-700' : '' }}"
                            >
                                {{ $logbook->status }}
                            </span>

                            <a
                                href="{{ route('lecturer.students.logbooks.show', ['student' => $student, 'dailyLogbook' => $logbook]) }}"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-blue-100 text-blue-700 text-sm font-semibold hover:bg-blue-200 transition"
                            >
                                View
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center px-6">
                    <h3 class="mt-4 font-semibold text-slate-700">
                        No daily logbooks found
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        This student has no submitted daily logbook records yet.
                    </p>
                </div>
            @endforelse
        </div>

        @if ($logbooks->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $logbooks->links() }}
            </div>
        @endif
    </div>

</x-app-layout>
