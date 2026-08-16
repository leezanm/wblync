<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                My Students
            </h2>

            {{-- <p class="text-sm text-slate-500 mt-1">
                Students currently assigned to you for supervision.
            </p> --}}

        </div>

    </x-slot>
    <div class="mb-6">

        <h2 class="text-2xl font-bold text-slate-800">
            My Students
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Students currently assigned to you for supervision.
        </p>

    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="p-6 border-b border-slate-100">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Supervised Students
                    </p>

                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        My Students
                    </h3>

                </div>


                <div class="px-4 py-2 rounded-xl bg-blue-50 text-blue-700 text-sm font-semibold">

                    {{ $students->total() }} Students

                </div>

            </div>

        </div>


        {{-- Students --}}
        <div class="p-6">

            @if ($students->count())

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($students as $assignment)

                        <div class="border border-slate-200 rounded-2xl p-5 hover:shadow-md transition">

                            {{-- Student --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">

                                    <svg
                                        class="w-6 h-6 text-blue-600"
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

                                </div>


                                <div class="min-w-0">

                                    <h4 class="font-bold text-slate-800 truncate">

                                        {{ $assignment->student?->name ?? '-' }}

                                    </h4>

                                    <p class="text-sm text-slate-500 mt-1">

                                        {{ $assignment->student?->student_no ?? '-' }}

                                    </p>

                                </div>

                            </div>


                            {{-- Student Information --}}
                            <div class="mt-5 space-y-3">

                                <div>

                                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                        Email
                                    </p>

                                    <p class="text-sm text-slate-600 mt-1 break-all">
                                        {{ $assignment->student?->email ?? '-' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                        Phone
                                    </p>

                                    <p class="text-sm text-slate-600 mt-1">
                                        {{ $assignment->student?->phone ?? '-' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                        Assigned Since
                                    </p>

                                    <p class="text-sm text-slate-600 mt-1">

                                        {{ $assignment->assigned_at?->format('d M Y') ?? '-' }}

                                    </p>

                                </div>

                            </div>


                            {{-- View Logbooks --}}
                            <div class="mt-5 pt-5 border-t border-slate-100">

                                <a
                                    href="{{ route('lecturer.students.logbooks.index',$assignment->student?->id) }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                                >

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z"
                                        />
                                    </svg>

                                    View Logbooks

                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="py-16 text-center">

                    <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center">

                        <svg
                            class="w-7 h-7 text-slate-400"
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
                        </svg>

                    </div>


                    <h3 class="mt-4 font-semibold text-slate-700">
                        No students assigned
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        You currently have no students assigned to you.
                    </p>

                </div>

            @endif

        </div>


        {{-- Pagination --}}
        @if ($students->hasPages())

            <div class="px-6 pb-6">

                {{ $students->links() }}

            </div>

        @endif

    </div>

</x-app-layout>
