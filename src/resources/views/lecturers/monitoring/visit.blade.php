<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <p class="text-xs  tracking-wide text-slate-400 font-semibold">
                    Monitoring
                </p>



            </div>



        </div>

    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

        <div>

            <h3 class="text-2xl  tracking-wide  font-semibold">
                Monitoring Visit {{ $monitoringNo }}
            </h3>
            <p class="text-sm text-slate-500 mt-1">
                Listing or monitoring report for visit
            </p>


        </div>

   <a
                href="{{ route('lecturer.monitoring.create',$monitoringNo) }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
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
                        stroke-width="2"
                        d="M12 5v14M5 12h14"
                    />
                </svg>

                Add Monitoring

            </a>

    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif






    {{-- Monitoring Visits --}}
    <div class="space-y-5">

        @forelse($monitorings as $monitoring)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 transition hover:shadow-md">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shrink-0">
                            {{ $monitoring->monitoring_no }}
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-blue-700 font-semibold">
                                {{ $monitoring->student?->student_no ?? 'Student' }}
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-slate-800">
                                {{ $monitoring->student?->name ?? 'Unknown Student' }}
                            </h3>

                            <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-600">
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 font-medium">
                                    Semester: {{ $monitoring->student?->classRoom?->semester?->name ?? 'Not assigned' }}
                                </span>
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 font-medium">
                                    Class: {{ $monitoring->student?->classRoom?->code ?? $monitoring->student?->classRoom?->name ?? 'Not assigned' }}
                                </span>
                            </div>

                            @if ($monitoring)
                                <p class="mt-3 text-sm text-slate-500">
                                    {{ $monitoring->monitoring_date?->format('d M Y') }}
                                </p>
                            @else
                                <p class="mt-3 text-sm text-slate-400">
                                    Not completed yet
                                </p>
                            @endif
                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        @if ($monitoring)
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                Completed
                            </span>

                            <a href="{{ route('lecturer.monitoring.show', $monitoring->id) }}"
                                class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition">
                                View
                            </a>
                        @else
                            <a href=""
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                                Fill Form
                            </a>
                        @endif

                    </div>

                </div>

            </div>
        @empty

                <div class="py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">

                        <svg
                            class="h-8 w-8 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m12 0H7m8-13a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>

                    </div>

                    <p class="mt-5 text-lg font-semibold text-slate-700">
                        No students found
                    </p>

                    <p class="mt-2 text-sm text-slate-500">
                        No students are currently assigned to you for monitoring.
                    </p>

                </div>

            @endforelse

    </div>





</x-app-layout>
