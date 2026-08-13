<x-app-layout>

    {{-- <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Dashboard
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Welcome back, {{ auth()->user()->name }}
            </p>
        </div>
    </x-slot> --}}

    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Academic Sessions --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Academic Sessions
                    </p>

                    <p class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $academicSessionsCount }}
                    </p>
                </div>

               <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M12 14.25L3.75 10.5 12 6.75l8.25 3.75L12 14.25z"/>
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M7.5 12.2v4.05c0 .75 2.01 2.25 4.5 2.25s4.5-1.5 4.5-2.25V12.2"/>
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M20.25 10.5v4.5"/>
    </svg>
</div>

            </div>

        </div>


        {{-- Students --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Students
                    </p>

                    <p class="text-3xl font-bold text-slate-800 mt-2">
                        0
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M15 19.5a6 6 0 00-6 0"/>
        <circle cx="12" cy="8" r="3.25"
                stroke="currentColor"
                stroke-width="1.8"/>
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M5.25 19.5a6.75 6.75 0 0113.5 0"/>
    </svg>
</div>

            </div>

        </div>


        {{-- Companies --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Companies
                    </p>

                    <p class="text-3xl font-bold text-slate-800 mt-2">
                        0
                    </p>
                </div>

               <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M4.5 21V5.25A1.25 1.25 0 015.75 4h12.5a1.25 1.25 0 011.25 1.25V21"/>
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M8 8h1.5M8 11h1.5M8 14h1.5M14.5 8H16M14.5 11H16M14.5 14H16"/>
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M9.5 21v-3.5h5V21"/>
    </svg>
</div>

            </div>

        </div>


        {{-- Pending Logbook --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Pending Logbook
                    </p>

                    <p class="text-3xl font-bold text-slate-800 mt-2">
                        0
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    📖
                </div>

            </div>

        </div>

    </div>


    {{-- Current Academic Session --}}
    <div class="mt-8">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Current Academic Session
                    </p>

                    @if ($currentAcademicSession)

                        <h3 class="text-2xl font-bold text-slate-800 mt-2">
                            {{ $currentAcademicSession->name }}
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            {{ $currentAcademicSession->start_date?->format('d/m/Y') }}
                            -
                            {{ $currentAcademicSession->end_date?->format('d/m/Y') }}
                        </p>

                    @else

                        <h3 class="text-xl font-semibold text-slate-400 mt-2">
                            No active academic session
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Please create and activate an academic session.
                        </p>

                    @endif

                </div>


                @if ($currentAcademicSession)

                    <span class="inline-flex items-center w-fit px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>

                        Active

                    </span>

                @else

                    <a
                        href="{{ route('academic-sessions.create') }}"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
                    >
                        + Create Session
                    </a>

                @endif

            </div>

        </div>

    </div>


    {{-- Quick Actions --}}
    <div class="mt-8">

        <h3 class="text-lg font-semibold text-slate-800 mb-4">
            Quick Actions
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <a
                href="{{ route('academic-sessions.create') }}"
                class="bg-white border border-slate-200 rounded-2xl p-5 hover:border-blue-400 hover:shadow-md transition"
            >

                <p class="font-semibold text-slate-800">
                    Create Academic Session
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    Set up a new academic session.
                </p>

            </a>

            <a
                href="{{ route('academic-sessions.index') }}"
                class="bg-white border border-slate-200 rounded-2xl p-5 hover:border-blue-400 hover:shadow-md transition"
            >

                <p class="font-semibold text-slate-800">
                    Manage Academic Sessions
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    View and manage existing sessions.
                </p>

            </a>

        </div>

    </div>

</x-app-layout>
