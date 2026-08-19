<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Programme Dashboard
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Overview of students, placements, logbooks, and monitoring activity across the system.
            </p>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Total Students
            </p>
            <p class="mt-2 text-3xl font-bold text-slate-800">
                {{ $studentsCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                {{ $activeStudentsCount }} active
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
                Across all companies
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

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Lecturers
            </p>
            <p class="mt-2 text-3xl font-bold text-sky-600">
                {{ $lecturersCount }}
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Programme supervisors
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
                Active mentor accounts
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

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                    @foreach ($placementStatusSummary as $item)
                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                {{ $item['status'] }}
                            </p>
                            <p class="mt-2 text-2xl font-bold text-slate-800">
                                {{ $item['total'] }}
                            </p>
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
                        Recent Submitted Daily Logbooks
                    </h3>
                    <a
                        href="{{ route('daily-logbooks.index') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                    >
                        View logbooks
                    </a>
                </div>

                <div class="p-6 space-y-4">
                    @forelse ($recentSubmittedLogbooks as $logbook)
                        <div class="rounded-xl border border-slate-200 p-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <p class="font-semibold text-slate-800">
                                    {{ $logbook->placement?->student?->name ?? '-' }}
                                </p>
                                <span class="inline-flex w-fit items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                    Submitted
                                </span>
                            </div>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $logbook->placement?->company?->name ?? '-' }}
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                Date: {{ $logbook->log_date?->format('d M Y') ?? '-' }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">
                            No submitted daily logbooks at the moment.
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
