<aside
    class="
        fixed
        inset-y-0
        left-0
        z-50
        w-72
        bg-slate-900
        text-white
        flex
        flex-col
        transform
        -translate-x-full
        lg:translate-x-0
        transition-transform
        duration-300
        ease-in-out
    "
    :class="{
        'translate-x-0': sidebarOpen
    }">

    {{-- Header --}}
    <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

            <div class="flex items-center justify-center">

                <img src="{{ asset('images/logo-putih4.png') }}" alt="WBLync Logo">

            </div>

        </a>


        {{-- Mobile Close --}}
        <button type="button" @click="sidebarOpen = false"
            class="lg:hidden w-10 h-10 rounded-lg hover:bg-slate-800 flex items-center justify-center">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>

        </button>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 min-h-0 overflow-y-auto p-4 space-y-1">
        {{-- <nav class="p-4 space-y-1 overflow-y-auto"> --}}


        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" @click="sidebarOpen = false"
            class="
                flex
                items-center
                gap-3
                px-4
                py-3
                rounded-xl
                transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
            ">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M3 12l9-9 9 9M5.25 10.5V21h13.5V10.5" />

            </svg>

            <span>
                Dashboard
            </span>

        </a>




        {{-- ========================================================= --}}
        {{-- Internship --}}
        {{-- ========================================================= --}}

        <div class="pt-6">

            <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                Internship
            </p>








            {{-- My Student Placement --}}
            <a href="{{ route('industry-supervisor.students') }}" @click="sidebarOpen = false"
                class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('industry-supervisor.students')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                ">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                    <circle cx="9" cy="7" r="4" stroke-width="1.8" />

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M22 21v-2a4 4 0 00-3-3.87" />

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 3.13a4 4 0 010 7.75" />
                </svg>

                <span>
                    My Students
                </span>
            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- Monitoring --}}
        {{-- ========================================================= --}}

        <div class="pt-6">

            <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                Monitoring
            </p>


            {{--  Logbook --}}

            <a href="{{ route('industry-supervisor.logbook-approvals.index') }}"
                class="
                        flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
                        {{ request()->routeIs('industry-supervisor.logbook-approvals.index')
                            ? 'bg-blue-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                    ">

                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4" />

                    <circle cx="12" cy="12" r="9" stroke-width="1.8" />
                </svg>

                <span>
                    Logbook Approvals
                </span>

            </a>



            <a href="{{ route('industry-supervisor.logbook-approvals.history') }}"
                class="
                        flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('industry-supervisor.logbook-approvals.history')
                            ? 'bg-blue-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                    ">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="8.25" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.8" />

                    <path d="M12 7.5v4.5l3 2.25" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" />
                </svg>
                <span>
                    Approval History
                </span>

            </a>
            {{-- ========================================================= --}}
            {{-- Assessment --}}
            {{-- ========================================================= --}}

            <div class="pt-6">

                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                    Assessment
                </p>

                {{-- My Assessments --}}
                <a href="{{ route('industry-supervisor.assessments.index') }}" @click="sidebarOpen = false"
                    class="
            flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('industry-supervisor.assessments.*')
                ? 'bg-blue-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
        ">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 5h6M9 9h6M9 13h4M6 3h9l3 3v15H6V3z" />
                    </svg>

                    <span>
                        My Assessments
                    </span>

                </a>

            </div>



        </div>


    </nav>




</aside>
