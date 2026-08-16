<header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30">

    <div class="h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">

        {{-- Left --}}
        <div class="flex items-center gap-3">

            {{-- Mobile Menu Button --}}
            <button
                type="button"
                @click="sidebarOpen = true"
                class="lg:hidden w-10 h-10 rounded-xl hover:bg-slate-100 flex items-center justify-center text-slate-600"
                aria-label="Open menu"
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />

                </svg>

            </button>


            {{-- Mobile Logo --}}
            <div class="lg:hidden font-bold text-lg text-slate-800">
                WBLync
            </div>


            {{-- Desktop Title --}}
            <div class="hidden lg:block">

                {{-- <p class="text-xs text-slate-400">
                    WBLync
                </p> --}}

                <h1 class="text-lg font-semibold text-slate-800">
                    {{ trim(strip_tags($header ?? 'Dashboard')) }}
                </h1>

            </div>

        </div>


        {{-- Right --}}
        <div class="flex items-center gap-3">

            {{-- Notification --}}
            <button
                type="button"
                class="w-10 h-10 rounded-xl hover:bg-slate-100 flex items-center justify-center text-slate-500"
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
                        d="M15 17H9m10-1.5a2 2 0 01-2-2V10a5 5 0 00-10 0v3.5a2 2 0 01-2 2h14z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M10 20h4"
                    />

                </svg>

            </button>


            @php
                $currentUser = auth()->user();
                $userRole = $currentUser?->roles->pluck('name')->implode(', ') ?: 'No Role';
            @endphp

            {{-- User --}}
            <div
                class="relative"
                x-data="{ userMenuOpen: false }"
            >
                <button
                    type="button"
                    @click="userMenuOpen = !userMenuOpen"
                    class="flex items-center gap-3 rounded-xl px-2 py-1 hover:bg-slate-100 transition"
                >
                    <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                        {{ strtoupper(substr($currentUser->name, 0, 1)) }}
                    </div>

                    <div class="hidden sm:block lg:block text-left">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ $currentUser->name }}
                        </p>

                        <p class="text-xs text-slate-500">
                            {{ $userRole }}
                        </p>
                    </div>

                    <svg
                        class="w-4 h-4 text-slate-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m19.5 8.25-7.5 7.5-7.5-7.5"
                        />
                    </svg>
                </button>

                <div
                    x-show="userMenuOpen"
                    @click.away="userMenuOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-52 rounded-xl border border-slate-200 bg-white shadow-lg z-40 overflow-hidden"
                >
                    <a
                        href="{{ route('profile.show') }}"
                        class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition"
                    >
                        User Profile
                    </a>

                    <a
                        href="{{ route('password.change.edit') }}"
                        class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition"
                    >
                        Change Password
                    </a>
                </div>
            </div>


            {{-- Logout --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="
                        flex
                        items-center
                        justify-center
                        gap-2
                        h-10
                        px-3
                        sm:px-0
                        sm:w-10
                        rounded-xl
                        text-slate-500
                        hover:bg-red-50
                        hover:text-red-600
                        transition
                    "
                    title="Logout"
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
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.25A2.25 2.25 0 004 5.25v13.5A2.25 2.25 0 006.25 21h7.25a2.25 2.25 0 002.25-2.25V15"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 12h8m0 0l-3-3m3 3l-3 3"
                        />

                    </svg>

                    <span class="sm:hidden text-sm font-medium">
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </div>

</header>
