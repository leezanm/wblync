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
        {{-- Monitoring --}}
        {{-- ========================================================= --}}

        <div class="pt-6">

            <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                Monitoring
            </p>
            {{-- My Students --}}
            <a
                href="{{ route('lecturer.students.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('lecturer.students.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    }}
                "
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                    />

                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                        stroke-width="1.8"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M22 21v-2a4 4 0 00-3-3.87"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M16 3.13a4 4 0 010 7.75"
                    />
                </svg>

                <span class="font-medium">
                    Assigned Students
                </span>

            </a>

           {{-- Monitoring --}}
            <a
                href="{{  route('lecturer.monitoring.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('lecturer.monitoring.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    }}
                "
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 2v4M16 2v4"
                    />

                    <rect
                        x="3"
                        y="4"
                        width="18"
                        height="18"
                        rx="2"
                        stroke-width="1.8"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M3 10h18"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 14h2M14 14h2M8 18h2"
                    />
                </svg>

                <span class="font-medium">
                    Monitoring
                </span>

            </a>

        </div>






    </nav>


    {{-- User --}}
    <div class="shrink-0 border-t border-slate-800 p-4 bg-slate-900">

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
