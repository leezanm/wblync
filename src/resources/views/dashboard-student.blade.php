<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-black">
                Dashboard Pelajar
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Selamat datang, {{ auth()->user()->name }}.
            </p>
        </div>
    </x-slot>

    @if (! $student)
        <div class="rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-amber-800">
            Profil pelajar anda belum lengkap. Sila hubungi penyelaras untuk kemas kini maklumat pelajar.
        </div>
    @else
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div>
                            <p class="text-sm/6 text-slate-200">No. Pelajar</p>
                            <h3 class="text-2xl font-bold text-white">{{ $student->student_no }}</h3>
                            <h5 class="text-xl font-bold text-white">{{ $student->name }}</h5>
                            <p class="text-sm mt-1 text-slate-100">
                                {{ $student->classRoom?->programme?->name ?? 'Programme belum ditetapkan' }}
                            </p>
                            <p class="text-sm text-slate-100">
                                {{ $student->classRoom?->name ?? 'Kelas belum ditetapkan' }}
                            </p>
                        </div>

                        @if ($currentAcademicSession)
                            <span class="inline-flex items-center rounded-full bg-white/20 px-4 py-2 text-xs font-semibold">
                                Sesi Semasa: {{ $currentAcademicSession->code }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kursus Berdaftar</p>
                        <p class="mt-2 text-3xl font-bold text-slate-800">{{ $enrolledCoursesCount }}</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Logbook Dihantar</p>
                        <p class="mt-2 text-3xl font-bold text-amber-600">{{ $submittedLogbooksCount }}</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Logbook Diluluskan</p>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ $approvedLogbooksCount }}</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jumlah LogBook</p>
                        <p class="mt-2 text-3xl font-bold text-indigo-600">
                            {{$totalLogbooksCount}}
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800">Aktiviti Logbook Terkini</h3>
                    </div>

                    <div class="p-6">
                        @forelse ($recentLogbooks as $logbook)
                            <div class="py-4 first:pt-0 last:pb-0 border-b last:border-b-0 border-slate-100">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <p class="font-semibold text-slate-800">{{ $logbook->log_date?->format('d/m/Y') }}</p>
                                    <span class="inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $logbook->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $logbook->status === 'Submitted' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $logbook->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $logbook->status === 'Draft' ? 'bg-slate-100 text-slate-700' : '' }}
                                    ">
                                        {{ $logbook->status }}
                                    </span>
                                </div>
                                <p class="text-sm text-slate-600 mt-2">{{ $logbook->activity }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Tiada rekod logbook lagi.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">Status Placement</h3>

                    @if ($activePlacement)
                        <div class="mt-4 space-y-4">
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide">Syarikat</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $activePlacement->company?->code ? $activePlacement->company->code . ' - ' : '' }}{{ $activePlacement->company?->name ?? '-' }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $activePlacement->company?->industry ?? 'Industri tidak dinyatakan' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide">Industry Supervisor</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $activePlacement->industrySupervisor?->name ?? 'Belum ditetapkan' }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $activePlacement->industrySupervisor?->position ?? '-' }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $activePlacement->industrySupervisor?->email ?? '-' }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $activePlacement->industrySupervisor?->phone ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide">Tempoh</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $activePlacement->start_date?->format('d/m/Y') }} - {{ $activePlacement->end_date?->format('d/m/Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide">Status</p>
                                <span class="mt-1 inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                    {{ $activePlacement->status }}
                                </span>
                            </div>
                        </div>
                    @else
                        <p class="mt-4 text-sm text-slate-500">Tiada placement aktif buat masa ini.</p>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">Tindakan Pantas</h3>
                    <div class="mt-4 space-y-3">
                        <a href="{{ route('daily-logbooks.index', ['student_id' => $student->id]) }}" class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Lihat Logbook Harian
                        </a>
                        {{-- <a href="{{ route('placements.index', ['student_id' => $student->id]) }}" class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Lihat Placement
                        </a>
                        <a href="{{ route('assessments.index', ['student_id' => $student->id]) }}" class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Lihat Penilaian
                        </a> --}}
                        <a href="{{ route('students.academic-profile', $student) }}" class="block rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Profil Akademik
                        </a>
                    </div>
                </div>

                {{-- <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jumlah Logbook</p>
                    <p class="mt-2 text-3xl font-bold text-slate-800">{{ $totalLogbooksCount }}</p>
                </div> --}}
            </div>
        </div>
    @endif

</x-app-layout>
