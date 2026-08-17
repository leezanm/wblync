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
                Monitoring
            </h3>
            <p class="text-sm text-slate-500 mt-1">
                Listing or monitoring report
            </p>


        </div>



    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Monitoring Visits --}}
    <div class="space-y-5">

        @for ($i = 1; $i <= 3; $i++)



            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shrink-0">
                            {{ $i }}
                        </div>


                        <div>

                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                Monitoring
                            </p>

                            <h3 class="text-xl font-bold text-slate-800 mt-1">
                                Visit {{ $i }}
                            </h3>

                            {{-- @if ($monitoring)

                                <p class="text-sm text-slate-500 mt-1">

                                    {{ $monitoring->monitoring_date?->format('d M Y') }}

                                </p>

                            @else

                                <p class="text-sm text-slate-400 mt-1">
                                    Not completed yet
                                </p>

                            @endif --}}

                        </div>

                    </div>


                    <div class="flex items-center gap-3">



                            <a
                                href="{{ (route('lecturer.monitoring.visit',$i)) }}"
                                class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-blue-100 text-blue-700 text-sm font-semibold hover:bg-blue-200 transition"
                            >
                                View Monitoring
                            </a>







                    </div>

                </div>

            </div>
        @endfor

    </div>

</x-app-layout>
