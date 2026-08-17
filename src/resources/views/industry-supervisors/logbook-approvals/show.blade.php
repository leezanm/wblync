<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Review Daily Logbook
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Review a daily logbook entry before approval.
                </p>
            </div>

            <a
                href="{{ route('industry-supervisor.logbook-approvals.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
            >
                Back to Approvals
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">
            <p class="text-sm font-semibold text-red-800 mb-2">
                Please correct the following errors:
            </p>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Student</p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $dailyLogbook->placement?->student?->name ?? '-' }}
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    {{ $dailyLogbook->placement?->student?->student_no ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Company</p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $dailyLogbook->placement?->company?->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Date</p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $dailyLogbook->log_date?->format('d M Y') ?? '-' }}
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    {{ $dailyLogbook->log_date?->format('l') ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Status</p>
                <span class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold
                    {{ $dailyLogbook->status === 'Submitted' ? 'bg-amber-100 text-amber-700' : '' }}
                    {{ $dailyLogbook->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $dailyLogbook->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ $dailyLogbook->status }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-xl font-bold text-slate-800">Daily Activity Details</h3>
        </div>

        <div class="p-6 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Work Status</p>
                <p class="mt-2 text-sm text-slate-700">{{ $dailyLogbook->work_status ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Working Hours</p>
                <p class="mt-2 text-sm text-slate-700">{{ $dailyLogbook->working_hours ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Activity</p>
                <p class="mt-2 text-sm text-slate-700 whitespace-pre-line">{{ $dailyLogbook->activity ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Learning Outcome</p>
                <p class="mt-2 text-sm text-slate-700 whitespace-pre-line">{{ $dailyLogbook->learning_outcome ?? '-' }}</p>
            </div>

            @if ($dailyLogbook->remarks)
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">Remarks</p>
                    <p class="mt-2 text-sm text-slate-700 whitespace-pre-line">{{ $dailyLogbook->remarks }}</p>
                </div>
            @endif
        </div>
    </div>

    @if ($dailyLogbook->status === 'Submitted')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-800">Supervisor Review</h3>
            <p class="text-sm text-slate-500 mt-1">
                Approve this daily logbook or reject it with remarks.
            </p>

            <div class="mt-6">
                <label for="remarks" class="block text-sm font-semibold text-slate-700 mb-2">
                    Supervisor Remarks
                    <span class="text-slate-400 font-normal">(required when rejecting)</span>
                </label>
                <textarea
                    id="remarks"
                    name="remarks"
                    form="reject-logbook-form"
                    rows="4"
                    class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                ></textarea>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6">
                <form
                    id="reject-logbook-form"
                    method="POST"
                    action="{{ route('industry-supervisor.logbook-approvals.reject', $dailyLogbook) }}"
                    onsubmit="return confirm('Reject this daily logbook?');"
                >
                    @csrf
                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition"
                    >
                        Reject
                    </button>
                </form>

                <form
                    method="POST"
                    action="{{ route('industry-supervisor.logbook-approvals.approve', $dailyLogbook) }}"
                    onsubmit="return confirm('Approve this daily logbook?');"
                >
                    @csrf
                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition"
                    >
                        Approve
                    </button>
                </form>
            </div>
        </div>
    @endif

</x-app-layout>
