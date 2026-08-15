<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <h2 class="text-2xl font-bold text-slate-800">
                Industry Mentor
            </h2>



        </div>

    </x-slot>
    <div class=" mt-6 mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                My Students
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Students currently assigned under your supervision.
            </p>

        </div>


    </div>


    {{-- Supervisor summary --}}
    {{-- <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                <span class="text-xl font-bold text-blue-600">
                    {{ strtoupper(substr($industrySupervisor->name, 0, 1)) }}
                </span>

            </div>


            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    {{ $industrySupervisor->name }}
                </h2>

                <p class="text-sm text-slate-500">
                    {{ $industrySupervisor->position ?? 'Industry Supervisor' }}
                </p>

            </div>

        </div>

    </div> --}}


    {{-- Students --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h3 class="text-lg font-bold text-slate-800">
                Students Under My Supervision
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                {{ $placements->total() }} student(s)
            </p>

        </div>


        @if ($placements->count())

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Student
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Student No
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Placement
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

                        @foreach ($placements as $placement)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $loop->iteration + ($placements->currentPage() - 1) * $placements->perPage() }}
                                </td>


                                <td class="px-6 py-4">

                                    <div class="font-semibold text-slate-800">
                                        {{ $placement->student?->name ?? '-' }}
                                    </div>

                                    @if ($placement->student?->email)

                                        <div class="text-xs text-slate-500 mt-1">
                                            {{ $placement->student->email }}
                                        </div>

                                    @endif

                                </td>


                                <td class="px-6 py-4">

                                    <span class="font-medium text-slate-700">
                                        {{ $placement->student?->student_no ?? '-' }}
                                    </span>

                                </td>


                                <td class="px-6 py-4">

                                    <div class="text-sm font-medium text-slate-700">
                                        {{ $placement->company?->name ?? '-' }}
                                    </div>

                                    <div class="text-xs text-slate-500 mt-1">

                                        {{ $placement->start_date?->format('d/m/Y') ?? '-' }}

                                        -

                                        {{ $placement->end_date?->format('d/m/Y') ?? '-' }}

                                    </div>

                                </td>


                                <td class="px-6 py-4">

                                    @if ($placement->status === 'Active')

                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">

                                            {{ $placement->status }}

                                        </span>

                                    @endif

                                </td>


                                <td class="px-6 py-4 text-right">

                                    <a
                                        href="{{ route('placements.show', $placement) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-50 text-blue-600 text-sm font-semibold hover:bg-blue-100"
                                    >
                                        View
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="p-6">

                {{ $placements->withQueryString()->links() }}

            </div>

        @else

            <div class="p-12 text-center">

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
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 font-semibold text-slate-700">
                    No students assigned
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    You currently have no students under your supervision.
                </p>

            </div>

        @endif

    </div>

</x-app-layout>
