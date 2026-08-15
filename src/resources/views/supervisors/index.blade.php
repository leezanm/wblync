<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Supervisors
                </h2>



            </div>



        </div>

    </x-slot>
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Supervisors
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manage lecturer supervisors and their student assignments.
                </p>

            </div>

            <a
                href="{{ route('supervisors.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
            >
                + Add Supervisor
            </a>

        </div>

    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 mt-6 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mb-6 mt-6">

        <form
            method="GET"
            action="{{ route('supervisors.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            <div class="md:col-span-4">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search supervisor or staff no..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            <div class="md:col-span-3">

                <select
                    name="academic_session_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50"
                >

                    <option value="">
                        All Academic Sessions
                    </option>

                    @foreach ($academicSessions as $session)

                        <option
                            value="{{ $session->id }}"
                            @selected(request('academic_session_id') == $session->id)
                        >
                            {{ $session->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="md:col-span-2">

                <select
                    name="semester_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50"
                >

                    <option value="">
                        All Semesters
                    </option>

                    @foreach ($semesters as $semester)

                        <option
                            value="{{ $semester->id }}"
                            @selected(request('semester_id') == $semester->id)
                        >
                            {{ $semester->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="md:col-span-3 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900"
                >
                    Filter
                </button>

                <a
                    href="{{ route('supervisors.index') }}"
                    class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50"
                >
                    Clear
                </a>

            </div>

        </form>

    </div>


    {{-- Desktop --}}
    <div class="hidden md:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Supervisor
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Academic Session
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Semester
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Students
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($supervisors as $supervisor)

                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($supervisors->currentPage() - 1) * $supervisors->perPage() }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $supervisor->lecturer?->name ?? '-' }}
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $supervisor->lecturer?->staff_no ?? '-' }}
                                </div>

                            </td>


                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $supervisor->academicSession?->name ?? '-' }}
                            </td>


                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $supervisor->semester?->name ?? '-' }}
                            </td>


                            <td class="px-6 py-4">

                                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                                    {{ $supervisor->students_count ?? $supervisor->students()->count() }}

                                    Students

                                </span>

                            </td>


                            <td class="px-6 py-4">

                                @if ($supervisor->status === 'Active')

                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('supervisors.show', $supervisor) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 hover:bg-blue-50"
                                        title="View"
                                    >
                                        👁
                                    </a>

                                    <a
                                        href="{{ route('supervisors.edit', $supervisor) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 hover:bg-amber-50"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('supervisors.destroy', $supervisor) }}"
                                        onsubmit="return confirm('Delete this supervisor registration?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50"
                                            title="Delete"
                                        >
                                            🗑
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No supervisors found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Register a lecturer as a supervisor to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if ($supervisors->hasPages())

        <div class="mt-6">
            {{ $supervisors->withQueryString()->links() }}
        </div>

    @endif

</x-app-layout>
