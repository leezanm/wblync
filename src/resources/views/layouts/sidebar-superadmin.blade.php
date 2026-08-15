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
        {{-- Academic --}}
        {{-- ========================================================= --}}

        <div class="pt-6">

            <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                Academic
            </p>


            {{-- Academic Session --}}
            <a
                href="{{ route('academic-sessions.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('academic-sessions.*')
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
                        d="M12 14.25L3.75 10.5 12 6.75l8.25 3.75L12 14.25z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M7.5 12.2v4.05c0 .75 2.01 2.25 4.5 2.25s4.5-1.5 4.5-2.25V12.2"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M20.25 10.5v4.5"
                    />

                </svg>

                <span>
                    Academic Session
                </span>

            </a>


            {{-- Semester --}}
            <a
                href="{{ route('semesters.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('semesters.*')
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

                    <rect
                        x="4"
                        y="5"
                        width="16"
                        height="14"
                        rx="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                    />

                    <path
                        d="M8 3v4M16 3v4M4 10h16"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                    />

                </svg>

                <span>
                    Semester
                </span>

            </a>


            {{-- Programme --}}
            <a
                href="{{ route('programmes.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('programmes.*')
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
                        d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5a2.25 2.25 0 012.25 2.25v13.5A2.25 2.25 0 0117.25 21H6.75a2.25 2.25 0 01-2.25-2.25V5.25z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 7.5h8M8 11h8M8 14.5h5"
                    />

                </svg>

                <span>
                    Programme
                </span>

            </a>


            {{-- Course --}}
            <a
                href="{{ route('courses.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('courses.*')
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
                        d="M5 4.75A2.75 2.75 0 017.75 2H19v18H7.75A2.75 2.75 0 015 17.25V4.75z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 8.5h6M9 12h6M9 15.5h4"
                    />

                </svg>

                <span>
                    Course
                </span>

            </a>


            {{-- Classes --}}
            <a
                href="{{ route('classes.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('classes.*')
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
                        d="M4 5.75A2.75 2.75 0 016.75 3h10.5A2.75 2.75 0 0120 5.75v12.5A2.75 2.75 0 0117.25 21H6.75A2.75 2.75 0 014 18.25V5.75z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 8h8M8 12h8M8 16h5"
                    />

                </svg>

                <span>
                    Classes
                </span>

            </a>

            {{-- Class Courses --}}
            <a
                href="{{ route('class-courses.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('class-courses.*')
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
                        d="M4 6.5A2.5 2.5 0 016.5 4h11A2.5 2.5 0 0120 6.5v11a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 17.5v-11z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 8h8M8 12h5M8 16h3"
                    />

                </svg>

                <span>
                    Class Courses
                </span>

            </a>


            {{-- Students --}}
            <a
                href="{{ route('students.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('students.*')
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
                        d="M16 19v-1.5A3.5 3.5 0 0012.5 14h-5A3.5 3.5 0 004 17.5V19M10 10a3 3 0 100-6 3 3 0 000 6zM16 7a3 3 0 110 6M17 19v-1.5a3.5 3.5 0 00-2-3.18"
                    />

                </svg>

                <span>
                    Students
                </span>

            </a>


            {{-- Enrolments --}}
            <a
                href="{{ route('enrollments.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('enrollments.*')
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
                        d="M7.5 3.75h9A2.25 2.25 0 0118.75 6v14.25H5.25V6A2.25 2.25 0 017.5 3.75z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 8.25h6M9 12h6M9 15.75h3"
                    />
                </svg>

                <span>
                    Enrolments
                </span>

            </a>



            {{-- Lecturers --}}
            <a
                href="{{ route('lecturers.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('lecturers.*')
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
                        d="M19 8v6M22 11h-6"
                    />
                </svg>

                <span>
                    Lecturers
                </span>
            </a>


        </div>


        {{-- ========================================================= --}}
        {{-- Internship --}}
        {{-- ========================================================= --}}

        <div class="pt-6">

            <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                Internship
            </p>



            {{-- Companies --}}
            <a
                href="{{ route('companies.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('companies.*')
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
                        d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2M9 11h2M9 15h2M15 7h2M15 11h2M15 15h2"
                    />

                </svg>

                <span>
                    Companies
                </span>

            </a>


            {{-- Company Contacts --}}
            <a
                href="{{ route('company-contacts.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('company-contacts.*')
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
                        d="M19 8v6M22 11h-6"
                    />

                </svg>

                <span>
                    Company Contacts
                </span>

            </a>


            {{-- Industry Supervisors --}}

            <a
                href="{{ route('industry-supervisors.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('industry-supervisors.*')
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
                        d="M16 19v-1.5A3.5 3.5 0 0012.5 14h-5A3.5 3.5 0 004 17.5V19M10 10a3 3 0 100-6 3 3 0 000 6z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M16 11a3 3 0 100-6"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M17 14.5a3.5 3.5 0 013 3.5V19"
                    />

                </svg>

                <span>
                    Industry Mentor
                </span>

            </a>


            {{-- Student Placement --}}
            <a
                href="{{ route('placements.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                    {{ request()->routeIs('placements.*')
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
                        d="M12 21s7-4.35 7-10.5A7 7 0 005 10.5C5 16.65 12 21 12 21z"
                    />

                    <circle
                        cx="12"
                        cy="10"
                        r="2.5"
                        stroke-width="1.8"
                    />

                </svg>

                <span>
                    Student Placement
                </span>

            </a>

            {{-- Supervisors --}}
            <a
                href="{{ route('supervisors.index') }}"
                @click="sidebarOpen = false"
                class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('supervisors.*')
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
                        d="M19 8v6M22 11h-6"
                    />
                </svg>

                <span>
                    Supervisors
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
        {{-- ========================================================= --}}
        {{-- Admin --}}
        {{-- ========================================================= --}}
        @can('view users')
            <div class="pt-6">

                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-500">
                    Administrator
                </p>
                {{-- Admin --}}


                    <a
                        href="{{ route('users.index') }}"
                        @click="sidebarOpen = false"
                        class="
                            flex
                            items-center
                            gap-3
                            px-4
                            py-3
                            rounded-xl
                            transition
                            {{ request()->routeIs('users.*')
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
                                d="M16 19v-1.5A3.5 3.5 0 0012.5 14h-5A3.5 3.5 0 004 17.5V19M10 10a3 3 0 100-6 3 3 0 000 6zM16 7a3 3 0 110 6"
                            />
                        </svg>

                        <span>
                            Users
                        </span>

                    </a>



            </div>
         @endcan

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
