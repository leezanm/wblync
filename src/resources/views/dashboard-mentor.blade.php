<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Industry Mentor Dashboard
            </h2>
            
        </div>
    </x-slot>

    @if (! $industrySupervisor)
        <div class="rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-amber-800">
            Your industry mentor profile is incomplete. Please contact the coordinator.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Students Under Supervision
                </p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ $supervisedStudentsCount }}
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Active Placements
                </p>
                <p class="mt-2 text-3xl font-bold text-indigo-600">
                    {{ $activePlacementsCount }}
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Pending Logbook Approvals
                </p>
                <p class="mt-2 text-3xl font-bold text-amber-600">
                    {{ $pendingApprovalsCount }}
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Reviewed Logbooks
                </p>
                <p class="mt-2 text-3xl font-bold text-green-600">
                    {{ $reviewedSubmissionsCount }}
                </p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                        <h3 class="text-lg font-bold text-slate-800">
                            Recent Logbook Submissions
                        </h3>
                        <a
                            href="{{ route('industry-supervisor.logbook-approvals.index') }}"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                        >
                            Review pending
                        </a>
                    </div>

                    <div class="p-6 space-y-4">
                        @forelse ($recentSubmissions as $submission)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <p class="font-semibold text-slate-800">
                                        {{ $submission->placement?->student?->name ?? '-' }}
                                    </p>
                                    <span
                                        class="inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $submission->status === 'Submitted' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $submission->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $submission->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}"
                                    >
                                        {{ $submission->status }}
                                    </span>
                                </div>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $submission->placement?->company?->name ?? '-' }}
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Date:
                                    {{ $submission->log_date?->format('d M Y') ?? '-' }}
                                </p>

                                <a
                                    href="{{ route('industry-supervisor.logbook-approvals.show', $submission) }}"
                                    class="mt-3 inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700"
                                >
                                    View submission
                                </a>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                No logbook submissions yet.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                        <h3 class="text-lg font-bold text-slate-800">
                            Active Placement Students
                        </h3>
                        <a
                            href="{{ route('industry-supervisor.students') }}"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                        >
                            View all students
                        </a>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse ($activePlacements as $placement)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="font-semibold text-slate-800">
                                    {{ $placement->student?->name ?? '-' }}
                                </p>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $placement->student?->student_no ?? '-' }}
                                </p>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $placement->company?->name ?? '-' }}
                                </p>
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ $placement->start_date?->format('d M Y') ?? '-' }}
                                    -
                                    {{ $placement->end_date?->format('d M Y') ?? '-' }}
                                </p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                No active placements under your supervision.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Mentor Information
                    </p>
                    <h3 class="text-xl font-bold text-slate-800 mt-2">
                        {{ $industrySupervisor->name }}
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ $industrySupervisor->position ?? 'Industry Mentor' }}
                    </p>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ $company?->name ?? '-' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Current Academic Session
                    </p>

                    @if ($currentAcademicSession)
                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            {{ $currentAcademicSession->name }}
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            {{ $currentAcademicSession->start_date?->format('d/m/Y') }}
                            -
                            {{ $currentAcademicSession->end_date?->format('d/m/Y') }}
                        </p>

                        <span class="mt-4 inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Active
                        </span>
                    @else
                        <p class="text-sm text-slate-500 mt-2">
                            No active academic session.
                        </p>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">
                        Quick Actions
                    </h3>

                    <div class="mt-4 space-y-3">
                        <a
                            href="{{ route('industry-supervisor.logbook-approvals.index') }}"
                            class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                        >
                            Review Pending Logbooks
                        </a>

                        <a
                            href="{{ route('industry-supervisor.logbook-approvals.history') }}"
                            class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                        >
                            View Approval History
                        </a>

                        <a
                            href="{{ route('industry-supervisor.students') }}"
                            class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                        >
                            View Supervised Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
