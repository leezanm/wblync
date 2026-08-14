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
    }"
>

    {{-- Header --}}
    <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3"
        >

            <div class="flex items-center justify-center">

                <img
                    src="{{ asset('images/logo-putih4.png') }}"
                    alt="WBLync Logo"
                >

            </div>

        </a>


        {{-- Mobile Close --}}
        <button
            type="button"
            @click="sidebarOpen = false"
            class="lg:hidden w-10 h-10 rounded-lg hover:bg-slate-800 flex items-center justify-center"
        >

            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

        </button>

    </div>


    {{-- Navigation --}}
  <nav class="flex-1 min-h-0 overflow-y-auto p-4 space-y-1">
      {{-- <nav class="p-4 space-y-1 overflow-y-auto"> --}}


        {{-- Dashboard --}}
        <a
            href="{{ route('dashboard') }}"
            @click="sidebarOpen = false"
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
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                }}
            "
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
                    stroke-width="1.8"
                    d="M3 12l9-9 9 9M5.25 10.5V21h13.5V10.5"
                />

            </svg>

            <span>
                Dashboard
            </span>

        </a>





        {{-- ========================================================= --}}
        {{-- Internship --}}
        {{-- ========================================================= --}}

        




        {{-- ========================================================= --}}
        {{-- Monitoring --}}
        {{-- ========================================================= --}}

        <div class="pt-6">

            <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                Monitoring
            </p>


            {{-- Daily Logbook --}}
            <a
                href="{{ route('daily-logbooks.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('daily-logbooks.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    }}
                "
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
                        stroke-width="1.8"
                        d="M6 3.75h9.5L19 7.25v13H6a2 2 0 01-2-2v-12.5a2 2 0 012-2z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 3.75v4h4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8.5 11h7M8.5 14.5h7M8.5 18h4"
                    />
                </svg>

                <span>
                    Daily Logbook
                </span>

            </a>


            {{-- Assessment --}}
            <a
                href="{{ route('assessments.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('assessments.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    }}
                "
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
                        stroke-width="1.8"
                        d="M6 3h9l3 3v15H6V3z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 11h6M9 15h6M9 7h3"
                    />

                </svg>

                <span>
                    Assessment
                </span>

            </a>


            {{-- Reports --}}
            <a
                href="#"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    text-slate-300
                    hover:bg-slate-800
                    hover:text-white
                "
            >

                <span class="w-5">
                    •
                </span>

                <span>
                    Reports
                </span>

            </a>

        </div>


    </nav>


    {{-- User --}}
 <div class="shrink-0 border-t border-slate-800 p-4 bg-slate-900">
    {{-- </div>   <div class="absolute bottom-0 left-0 right-0 border-t border-slate-800 p-4 bg-slate-900"> --}}

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-semibold">

                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

            </div>


            <div class="min-w-0">

                <p class="text-sm font-semibold truncate">

                    {{ auth()->user()->name }}

                </p>

                <p class="text-xs text-slate-400 truncate">

                    {{ auth()->user()->email }}

                </p>

            </div>

        </div>

    </div>

</aside>
