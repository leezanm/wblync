<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Monitoring
                </p>

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    Lawatan {{ $monitoring->monitoring_no }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $monitoring->student->name }}
                    @if ($monitoring->student->student_no)
                        · {{ $monitoring->student->student_no }}
                    @endif
                </p>
            </div>

            <a
                href="{{ route('lecturer.monitoring.student', $monitoring->student) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
            >
                ← Kembali
            </a>

        </div>
    </x-slot>


    {{-- STATUS --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>
                <div class="flex items-center gap-3">

                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                        {{ $monitoring->status }}
                    </span>

                    <span class="text-sm text-slate-400">
                        Lawatan {{ $monitoring->monitoring_no }} / 3
                    </span>
                </div>

                <p class="text-sm text-slate-500 mt-3">
                    Tarikh pemantauan:
                    <span class="font-semibold text-slate-700">
                        {{ $monitoring->monitoring_date?->format('d M Y') ?? '-' }}
                    </span>
                </p>
            </div>

            <div class="text-sm text-slate-500">

                <p>
                    Borang:
                    <span class="font-semibold text-slate-700">
                        {{ $monitoring->monitoringFormTemplate->name ?? 'Monitoring Form' }}
                    </span>
                </p>

                @if ($monitoring->monitoringFormTemplate?->version)
                    <p class="mt-1">
                        Version:
                        <span class="font-semibold text-slate-700">
                            {{ $monitoring->monitoringFormTemplate->version }}
                        </span>
                    </p>
                @endif

            </div>

        </div>

    </div>


    {{-- BASIC INFORMATION --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <h3 class="text-lg font-bold text-slate-800 mb-5">
            Maklumat Pemantauan
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Pelajar
                </p>

                <p class="font-semibold text-slate-800 mt-1">
                    {{ $monitoring->student->name }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    No. Pelajar
                </p>

                <p class="font-semibold text-slate-800 mt-1">
                    {{ $monitoring->student->student_no ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Lapor Diri
                </p>

                <p class="font-semibold text-slate-800 mt-1">
                    {{ $monitoring->reported_to ? 'Ya' : 'Tidak' }}

                    @if ($monitoring->reported_at)
                        <span class="text-sm text-slate-500">
                            ({{ $monitoring->reported_at->format('H:i') }})
                        </span>
                    @endif
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Syarikat
                </p>

                <p class="font-semibold text-slate-800 mt-1">
                    {{ $monitoring->placement->company->name ?? '-' }}
                </p>
            </div>

        </div>

    </div>


    {{-- FORM RESPONSES --}}
    @foreach ($monitoring->monitoringFormTemplate->sections as $section)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

            <div class="p-6 bg-slate-50 border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shrink-0">
                        {{ $section->section_no }}
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-800">
                            {{ $section->title }}
                        </h3>

                        <p class="text-xs text-slate-400 mt-1">
                            Rekod penilaian pemantauan
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-6 space-y-8">

                @foreach ($section->items as $item)

                    @php
                        $response = $monitoring->responses->firstWhere('item_id', $item->id);
                    @endphp

                    <div>

                        <h4 class="text-base font-bold text-slate-800">
                            {{ $item->label }}
                        </h4>

                        @if ($item->description)
                            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                                {{ $item->description }}
                            </p>
                        @endif


                        @if ($item->item_type === 'rating')

                            <div class="mt-4 space-y-3">

                                @foreach ($item->options as $option)

                                    @php
                                        $selected = $response?->option_id === $option->id;
                                    @endphp

                                    <div class="flex items-start gap-4 rounded-xl border p-4
                                        {{ $selected
                                            ? 'border-blue-500 bg-blue-50 ring-1 ring-blue-500'
                                            : 'border-slate-200 bg-white'
                                        }}"
                                    >

                                        <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2
                                            {{ $selected
                                                ? 'border-blue-600 bg-blue-600'
                                                : 'border-slate-300 bg-white'
                                            }}"
                                        >
                                            @if ($selected)
                                                <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                                            @endif
                                        </div>

                                        <div class="min-w-0 flex-1">

                                            <div class="flex items-center gap-2">

                                                <p class="font-bold text-slate-800">
                                                    {{ $option->label }}
                                                </p>

                                                @if ($selected)
                                                    <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold uppercase">
                                                        Dipilih
                                                    </span>
                                                @endif

                                            </div>

                                            @if ($option->description)
                                                <p class="mt-1 text-sm leading-relaxed text-slate-500">
                                                    {{ $option->description }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                        @elseif ($item->item_type === 'yes_no')

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">

                                @foreach ($item->options as $option)

                                    @php
                                        $selected = $response?->option_id === $option->id;
                                    @endphp

                                    <div class="flex items-center gap-3 rounded-xl border p-4
                                        {{ $selected
                                            ? 'border-blue-500 bg-blue-50 ring-1 ring-blue-500'
                                            : 'border-slate-200 bg-white'
                                        }}"
                                    >

                                        <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2
                                            {{ $selected
                                                ? 'border-blue-600 bg-blue-600'
                                                : 'border-slate-300 bg-white'
                                            }}"
                                        >
                                            @if ($selected)
                                                <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                                            @endif
                                        </div>

                                        <span class="font-bold text-slate-800">
                                            {{ $option->label }}
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        @endif


                        @if ($response?->answer)

                            <div class="mt-4 rounded-xl bg-slate-50 border border-slate-200 p-4">

                                <p class="text-xs uppercase tracking-wide text-slate-400 font-bold mb-2">
                                    Ulasan
                                </p>

                                <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line">
                                    {{ $response->answer }}
                                </p>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>

    @endforeach


    <div class="flex justify-end mb-10">

        <a
            href="{{ route('lecturer.monitoring.student', $monitoring->student) }}"
            class="px-5 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200"
        >
            Kembali ke Senarai Monitoring
        </a>

    </div>

</x-app-layout>
