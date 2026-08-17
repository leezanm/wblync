<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    Daily Logbook
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-slate-800 mt-1">
                Daily Logbook
            </h3>
            <p class="text-sm text-slate-500 mt-1">
                Read-only detail for monitoring purposes.
            </p>
        </div>

        <a
            href="{{ route('lecturer.students.logbooks.index', $student) }}"
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
            Back to Daily Logbooks
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Student
                </p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $student->name }}
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    {{ $student->student_no ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Company
                </p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $dailyLogbook->placement?->company?->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Date
                </p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $dailyLogbook->log_date?->format('d M Y') ?? '-' }}
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    {{ $dailyLogbook->log_date?->format('l') ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Industry Approval
                </p>
                <div class="mt-2">
                    <span
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold
                        {{ $dailyLogbook->status === 'Submitted' ? 'bg-amber-100 text-amber-700' : '' }}
                        {{ $dailyLogbook->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $dailyLogbook->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $dailyLogbook->status === 'Draft' ? 'bg-slate-100 text-slate-700' : '' }}"
                    >
                        {{ $dailyLogbook->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 px-5 py-4">
        <p class="text-sm text-blue-700">
            This logbook can be viewed for monitoring purposes. Approval or rejection is handled by the Industry Supervisor.
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-xl font-bold text-slate-800">
                Daily Activity Details
            </h3>
        </div>

        <div class="p-6 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Work Status
                </p>
                <p class="mt-2 text-sm text-slate-700">
                    {{ $dailyLogbook->work_status ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Working Hours
                </p>
                <p class="mt-2 text-sm text-slate-700">
                    {{ $dailyLogbook->working_hours ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Activity
                </p>
                <p class="mt-2 text-sm text-slate-700 whitespace-pre-line">
                    {{ $dailyLogbook->activity ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Learning Outcome
                </p>
                <p class="mt-2 text-sm text-slate-700 whitespace-pre-line">
                    {{ $dailyLogbook->learning_outcome ?? '-' }}
                </p>
            </div>

            @if ($dailyLogbook->remarks)
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Remarks
                    </p>
                    <p class="mt-2 text-sm text-slate-700 whitespace-pre-line">
                        {{ $dailyLogbook->remarks }}
                    </p>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
