<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Lecturer Dashboard
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Welcome, {{ auth()->user()->name }}.
            </p>
        </div>
    </x-slot>

    @if (! $lecturer)
        <div class="rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-amber-800">
            Your lecturer profile is incomplete. Please contact the coordinator to update your lecturer information.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Assigned Students
                </p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ $assignedStudentsCount }}
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
                    Pending Logbook Reviews
                </p>
                <p class="mt-2 text-3xl font-bold text-amber-600">
                    {{ $pendingLogbookReviewsCount }}
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Completed Monitorings
                </p>
                <p class="mt-2 text-3xl font-bold text-green-600">
                    {{ $completedMonitoringsCount }}
                </p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                        <h3 class="text-lg font-bold text-slate-800">
                            Recent Daily Logbooks
                        </h3>
                        <a
                            href="{{ route('lecturer.students.index') }}"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                        >
                            View students
                        </a>
                    </div>

                    <div class="p-6 space-y-4">
                        @forelse ($recentDailyLogbooks as $logbook)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <p class="font-semibold text-slate-800">
                                        {{ $logbook->placement?->student?->name ?? '-' }}
                                    </p>
                                    <span
                                        class="inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $logbook->status === 'Submitted' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $logbook->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $logbook->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}"
                                    >
                                        {{ $logbook->status }}
                                    </span>
                                </div>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $logbook->placement?->company?->name ?? '-' }}
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Date:
                                    {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                                </p>

                                @if ($logbook->placement?->student)
                                    <a
                                        href="{{ route('lecturer.students.logbooks.index', $logbook->placement->student) }}"
                                        class="mt-3 inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700"
                                    >
                                        Review logbooks
                                    </a>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                No daily logbooks yet.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                        <h3 class="text-lg font-bold text-slate-800">
                            Monitoring Visit Summary
                        </h3>
                        <a
                            href="{{ route('lecturer.monitoring.index') }}"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                        >
                            View monitoring
                        </a>
                    </div>

                    <div class="p-6 space-y-4">
                        @foreach ($monitoringVisitSummary as $summary)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="font-semibold text-slate-800">
                                        Visit {{ $summary['visit_no'] }}
                                    </p>
                                    <span class="text-sm font-bold text-slate-700">
                                        {{ $summary['total'] }}
                                    </span>
                                </div>

                                <div class="mt-3 h-3 rounded-full bg-slate-100 overflow-hidden">
                                    <div
                                        class="h-full rounded-full bg-blue-500 transition-all"
                                        style="width: {{ $summary['bar_percent'] }}%;"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                        <h3 class="text-lg font-bold text-slate-800">
                            Assigned Students
                        </h3>
                        <a
                            href="{{ route('lecturer.students.index') }}"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                        >
                            View all
                        </a>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse ($assignedStudents as $student)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="font-semibold text-slate-800">
                                    {{ $student->name }}
                                </p>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $student->student_no ?? '-' }}
                                </p>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $student->placements->first()?->company?->name ?? 'No active placement' }}
                                </p>

                                <div class="mt-3 flex flex-wrap gap-2">
                                    <a
                                        href="{{ route('lecturer.students.logbooks.index', $student) }}"
                                        class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white hover:bg-blue-700"
                                    >
                                        Logbooks
                                    </a>
                                    <a
                                        href="{{ route('lecturer.students.assessments.index', $student) }}"
                                        class="inline-flex items-center rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-700"
                                    >
                                        Assessments
                                    </a>
                                    
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                No students assigned to you yet.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
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
                            href="{{ route('lecturer.students.index') }}"
                            class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                        >
                            View Assigned Students
                        </a>

                        <a
                            href="{{ route('lecturer.monitoring.index') }}"
                            class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                        >
                            Manage Monitoring Visits
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
