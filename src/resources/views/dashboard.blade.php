<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Dashboard
            </h2>

        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Total Students
            </p>
            <p class="mt-2 text-3xl font-bold text-slate-800">
                {{ $studentsCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Data dalam sistem
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Lecturers
            </p>
            <p class="mt-2 text-3xl font-bold text-sky-600">
                {{ $lecturersCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Data dalam sistem
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Companies
            </p>
            <p class="mt-2 text-3xl font-bold text-indigo-600">
                {{ $companiesCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Data dalam sistem
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Industry Mentors
            </p>
            <p class="mt-2 text-3xl font-bold text-emerald-600">
                {{ $industryMentorsCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Data dalam sistem
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Active Placements
            </p>
            <p class="mt-2 text-3xl font-bold text-indigo-600">
                {{ $activePlacementsCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Ongoing placements
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Pending Daily Logbooks
            </p>
            <p class="mt-2 text-3xl font-bold text-amber-600">
                {{ $pendingLogbooksCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Waiting for mentor review
            </p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                            Programme Pipeline
                        </p>
                        <h3 class="text-lg font-bold text-slate-800 mt-1">
                            Placement Status Summary
                        </h3>
                    </div>
                    <a
                        href="{{ route('placements.index') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                    >
                        View placements
                    </a>
                </div>

                @php
                    $placementStatusStyles = [
                        'Draft' => ['badge' => 'bg-slate-100 text-slate-700', 'bar' => 'bg-slate-400', 'border' => 'border-slate-300'],
                        'Applied' => ['badge' => 'bg-blue-100 text-blue-700', 'bar' => 'bg-blue-500', 'border' => 'border-blue-300'],
                        'Approved' => ['badge' => 'bg-cyan-100 text-cyan-700', 'bar' => 'bg-cyan-500', 'border' => 'border-cyan-300'],
                        'Active' => ['badge' => 'bg-emerald-100 text-emerald-700', 'bar' => 'bg-emerald-500', 'border' => 'border-emerald-300'],
                        'Completed' => ['badge' => 'bg-violet-100 text-violet-700', 'bar' => 'bg-violet-500', 'border' => 'border-violet-300'],
                        'Rejected' => ['badge' => 'bg-red-100 text-red-700', 'bar' => 'bg-red-500', 'border' => 'border-red-300'],
                        'Cancelled' => ['badge' => 'bg-amber-100 text-amber-700', 'bar' => 'bg-amber-500', 'border' => 'border-amber-300'],
                    ];
                    $placementTotal = collect($placementStatusSummary)->sum('total');
                @endphp
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                    @foreach ($placementStatusSummary as $item)
                        @php
                            $style = $placementStatusStyles[$item['status']] ?? ['badge' => 'bg-slate-100 text-slate-700', 'bar' => 'bg-slate-400', 'border' => 'border-slate-300'];
                            $percent = $placementTotal > 0 ? (int) round(($item['total'] / $placementTotal) * 100) : 0;
                        @endphp
                        <div class="rounded-xl border p-4 {{ $style['border'] }}">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $style['badge'] }}">
                                {{ $item['status'] }}
                            </span>
                            <p class="mt-2 text-2xl font-bold text-slate-800">
                                {{ $item['total'] }}
                            </p>
                            <div class="mt-3 h-2 rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-full rounded-full {{ $style['bar'] }}" style="width: {{ $percent }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                            Monitoring Overview
                        </p>
                        <h3 class="text-lg font-bold text-slate-800 mt-1">
                            Monitoring Visits by Visit Number
                        </h3>
                    </div>
                    <a
                        href="{{ route('lecturer.monitoring.index') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                    >
                        View monitoring
                    </a>
                </div>

                <div class="p-6 space-y-4">
                    @foreach ($monitoringVisitSummary as $summary)
                        @php
                            $visitStyle = match ($summary['visit_no']) {
                                1 => 'bg-blue-500',
                                2 => 'bg-violet-500',
                                3 => 'bg-emerald-500',
                                default => 'bg-slate-500',
                            };
                        @endphp
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
                                    class="h-full rounded-full transition-all {{ $visitStyle }}"
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
                        Daily Logbook Status Summary
                    </h3>
                    <a
                        href="{{ route('daily-logbooks.index') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                    >
                        View all
                    </a>
                </div>

                @php
                    $logbookCounts = collect($logbookStatusSummary)
                        ->keyBy('status')
                        ->map(fn ($item) => (int) $item['total']);
                    $logbookTotal = $logbookCounts->sum();
                    $logbookDraft = $logbookCounts->get('Draft', 0);
                    $logbookSubmitted = $logbookCounts->get('Submitted', 0);
                    $logbookApproved = $logbookCounts->get('Approved', 0);
                    $logbookRejected = $logbookCounts->get('Rejected', 0);

                    $logbookDraftPct = $logbookTotal > 0 ? round(($logbookDraft / $logbookTotal) * 100, 2) : 0;
                    $logbookSubmittedPct = $logbookTotal > 0 ? round(($logbookSubmitted / $logbookTotal) * 100, 2) : 0;
                    $logbookApprovedPct = $logbookTotal > 0 ? round(($logbookApproved / $logbookTotal) * 100, 2) : 0;
                    $logbookRejectedPct = $logbookTotal > 0 ? round(($logbookRejected / $logbookTotal) * 100, 2) : 0;

                    $stop1 = $logbookDraftPct;
                    $stop2 = $stop1 + $logbookSubmittedPct;
                    $stop3 = $stop2 + $logbookApprovedPct;
                @endphp
                <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                    <div class="flex justify-center">
                        <div class="relative h-40 w-40 rounded-full"
                            style="{{ $logbookTotal > 0
                                ? 'background: conic-gradient(#94a3b8 0% '.$stop1.'%, #f59e0b '.$stop1.'% '.$stop2.'%, #10b981 '.$stop2.'% '.$stop3.'%, #ef4444 '.$stop3.'% 100%);'
                                : 'background: #e2e8f0;' }}">
                            <div class="absolute inset-5 rounded-full bg-white flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-xs text-slate-500 font-semibold uppercase">Total</p>
                                    <p class="text-3xl font-bold text-slate-800">{{ $logbookTotal }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-xl border border-slate-300 p-4">
                            <p class="text-xs font-semibold uppercase text-slate-500">Draft</p>
                            <p class="mt-1 text-xl font-bold text-slate-800">{{ $logbookDraft }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($logbookDraftPct, 1) }}%</p>
                        </div>
                        <div class="rounded-xl border border-amber-300 p-4">
                            <p class="text-xs font-semibold uppercase text-amber-700">Submitted</p>
                            <p class="mt-1 text-xl font-bold text-amber-700">{{ $logbookSubmitted }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($logbookSubmittedPct, 1) }}%</p>
                        </div>
                        <div class="rounded-xl border border-emerald-300 p-4">
                            <p class="text-xs font-semibold uppercase text-emerald-700">Approved</p>
                            <p class="mt-1 text-xl font-bold text-emerald-700">{{ $logbookApproved }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($logbookApprovedPct, 1) }}%</p>
                        </div>
                        <div class="rounded-xl border border-red-300 p-4">
                            <p class="text-xs font-semibold uppercase text-red-700">Rejected</p>
                            <p class="mt-1 text-xl font-bold text-red-700">{{ $logbookRejected }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($logbookRejectedPct, 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                    <h3 class="text-lg font-bold text-slate-800">
                        Mentor Assessment Status Summary
                    </h3>
                    <a
                        href="{{ route('admin.student-assessments.index') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                    >
                        View assessments
                    </a>
                </div>

                @php
                    $assessmentCounts = collect($mentorAssessmentStatusSummary)
                        ->keyBy('status')
                        ->map(fn ($item) => (int) $item['total']);
                    $assessmentTotal = $assessmentCounts->sum();
                    $assessmentDraft = $assessmentCounts->get('Draft', 0);
                    $assessmentCompleted = $assessmentCounts->get('Completed', 0);
                    $assessmentDraftPct = $assessmentTotal > 0 ? round(($assessmentDraft / $assessmentTotal) * 100, 2) : 0;
                    $assessmentCompletedPct = $assessmentTotal > 0 ? round(($assessmentCompleted / $assessmentTotal) * 100, 2) : 0;
                @endphp
                <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                    <div class="flex justify-center">
                        <div class="relative h-40 w-40 rounded-full"
                            style="{{ $assessmentTotal > 0
                                ? 'background: conic-gradient(#f59e0b 0% '.$assessmentDraftPct.'%, #8b5cf6 '.$assessmentDraftPct.'% 100%);'
                                : 'background: #e2e8f0;' }}">
                            <div class="absolute inset-5 rounded-full bg-white flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-xs text-slate-500 font-semibold uppercase">Total</p>
                                    <p class="text-2xl font-bold text-slate-800">{{ $assessmentTotal }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-xl border border-amber-300 p-4">
                            <p class="text-xs font-semibold uppercase text-amber-700">Draft</p>
                            <p class="mt-1 text-xl font-bold text-amber-700">{{ $assessmentDraft }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($assessmentDraftPct, 1) }}%</p>
                        </div>
                        <div class="rounded-xl border border-violet-300 p-4">
                            <p class="text-xs font-semibold uppercase text-violet-700">Completed</p>
                            <p class="mt-1 text-xl font-bold text-violet-700">{{ $assessmentCompleted }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($assessmentCompletedPct, 1) }}%</p>
                        </div>
                    </div>
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
                <div class="flex items-center justify-between gap-3">
                    <h3 class="text-lg font-bold text-slate-800">
                        User Login Frequency (7 Days)
                    </h3>
                </div>

                <div class="mt-4 space-y-3">
                    @foreach ($loginFrequencySummary as $item)
                        <div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-slate-700">{{ $item['label'] }}</span>
                                <span class="text-slate-500">{{ $item['total'] }}</span>
                            </div>
                            <div class="mt-1 h-2 rounded-full bg-slate-100 overflow-hidden">
                                <div
                                    class="h-full rounded-full bg-blue-500"
                                    style="width: {{ $item['bar_percent'] }}%;"
                                ></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-3">
                        <p class="text-xs uppercase font-semibold text-blue-600">Today</p>
                        <p class="mt-1 text-lg font-bold text-blue-700">{{ $usersLoggedInTodayCount }}</p>
                    </div>
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-3">
                        <p class="text-xs uppercase font-semibold text-emerald-600">Last 7 Days</p>
                        <p class="mt-1 text-lg font-bold text-emerald-700">{{ $usersLoggedIn7DaysCount }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                        <p class="text-xs uppercase font-semibold text-slate-600">Never Login</p>
                        <p class="mt-1 text-lg font-bold text-slate-700">{{ $usersNeverLoggedInCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">
                    Monitoring Template
                </p>

                @if ($activeMonitoringTemplate)
                    <h3 class="text-xl font-bold text-slate-800 mt-2">
                        {{ $activeMonitoringTemplate->name }}
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Version {{ $activeMonitoringTemplate->version }}
                    </p>
                    <span class="mt-4 inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                        Active Template
                    </span>
                @else
                    <p class="text-sm text-slate-500 mt-2">
                        No active monitoring template configured.
                    </p>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800">
                    Recent Monitoring Records
                </h3>

                <div class="mt-4 space-y-3">
                    @forelse ($recentMonitorings as $monitoring)
                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="font-semibold text-slate-800">
                                {{ $monitoring->student?->name ?? '-' }}
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                Visit {{ $monitoring->monitoring_no }}
                                @if ($monitoring->monitoring_date)
                                    • {{ $monitoring->monitoring_date->format('d M Y') }}
                                @endif
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $monitoring->placement?->company?->name ?? '-' }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">
                            No monitoring records yet.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800">
                    Quick Actions
                </h3>

                <div class="mt-4 space-y-3">
                    <a
                        href="{{ route('students.index') }}"
                        class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                    >
                        Manage Students
                    </a>
                    <a
                        href="{{ route('placements.index') }}"
                        class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                    >
                        Manage Placements
                    </a>
                    <a
                        href="{{ route('industry-supervisors.index') }}"
                        class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                    >
                        Manage Industry Mentors
                    </a>
                    <a
                        href="{{ route('admin.monitoring-form-templates.index') }}"
                        class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-400 hover:text-blue-700"
                    >
                        Manage Monitoring Templates
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
