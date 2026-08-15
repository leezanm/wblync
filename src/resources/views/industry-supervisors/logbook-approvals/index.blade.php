<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Logbook Approvals
            </h2>


        </div>

    </x-slot>

    <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-800">
                Logbook Approvals
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Review weekly logbooks submitted by students under your supervision.
            </p>
        </div>


    {{-- Success Message --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">

            {{ session('success') }}

        </div>

    @endif


    {{-- Error Message --}}
    @if (session('error'))

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm font-medium text-red-800">

            {{ session('error') }}

        </div>

    @endif


    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="p-6 border-b border-slate-100">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                        Pending Review
                    </p>

                    <h3 class="text-xl font-bold text-slate-800 mt-1">
                        Weekly Logbooks
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Students who have submitted their weekly logbook for your review.
                    </p>

                </div>


                {{-- Pending Count --}}
                <div class="inline-flex items-center gap-2 self-start px-4 py-2 rounded-xl bg-amber-50 border border-amber-100">

                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>

                    <span class="text-sm font-semibold text-amber-700">
                        {{ $submissions->total() }} Pending
                    </span>

                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Student
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Week
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Submitted
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($submissions as $submission)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Student --}}
                            <td class="px-6 py-5">

                                <div class="font-semibold text-slate-800">
                                    {{ $submission->placement?->student?->name ?? '-' }}
                                </div>

                                <div class="text-sm text-slate-500 mt-1">
                                    {{ $submission->placement?->student?->student_no ?? '-' }}
                                </div>

                            </td>


                            {{-- Company --}}
                            <td class="px-6 py-5">

                                <div class="text-sm font-medium text-slate-700">
                                    {{ $submission->placement?->company?->name ?? '-' }}
                                </div>

                            </td>


                            {{-- Week --}}
                            <td class="px-6 py-5 whitespace-nowrap">

                                <div class="text-sm font-semibold text-slate-700">

                                    {{ $submission->week_start_date?->format('d M Y') ?? '-' }}

                                    <span class="text-slate-400 font-normal">
                                        -
                                    </span>

                                    {{ $submission->week_end_date?->format('d M Y') ?? '-' }}

                                </div>

                            </td>


                            {{-- Submitted --}}
                            <td class="px-6 py-5 whitespace-nowrap">

                                @if ($submission->submitted_at)

                                    <div class="text-sm text-slate-700">
                                        {{ $submission->submitted_at->format('d M Y') }}
                                    </div>

                                    <div class="text-xs text-slate-400 mt-1">
                                        {{ $submission->submitted_at->format('h:i A') }}
                                    </div>

                                @else

                                    <span class="text-sm text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5">

                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                    Submitted

                                </span>

                            </td>


                            {{-- Action --}}
                            <td class="px-6 py-5 whitespace-nowrap">

                                <div class="flex justify-end">

                                    <a
                                        href="{{ route(
                                            'industry-supervisor.logbook-approvals.show',
                                            $submission
                                        ) }}"
                                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
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

                                        Review

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="w-14 h-14 mx-auto rounded-2xl bg-green-50 flex items-center justify-center">

                                    <svg
                                        class="w-7 h-7 text-green-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </div>


                                <h3 class="mt-4 font-semibold text-slate-700">
                                    No pending logbook approvals
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    There are currently no weekly logbooks waiting for your review.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($submissions->hasPages())

            <div class="p-6 border-t border-slate-100">

                {{ $submissions->links() }}

            </div>

        @endif

    </div>

</x-app-layout>
