<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Lecturers
                </h2>



            </div>




        </div>

    </x-slot>

     <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 ">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    List Of Lecturers
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manage lecturers.
                </p>

            </div>


            <a
                href="{{ route('lecturers.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
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
                        stroke-width="2"
                        d="M12 5v14M5 12h14"
                    />
                </svg>

                Add Lecturer

            </a>

        </div>


    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 mt-6 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    @if ($errors->any())

        <div class="mb-6 mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-700">

            <ul class="list-disc list-inside space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mb-6">

        <form
            method="GET"
            action="{{ route('lecturers.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            <div class="md:col-span-7">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search staff no, name, email or phone..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            <div class="md:col-span-3">

                <select
                    name="status"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="Active"
                        @selected(request('status') === 'Active')
                    >
                        Active
                    </option>

                    <option
                        value="Inactive"
                        @selected(request('status') === 'Inactive')
                    >
                        Inactive
                    </option>

                </select>

            </div>


            <div class="md:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900 transition"
                >
                    Filter
                </button>

                @if (request()->hasAny(['search', 'status']))

                    <a
                        href="{{ route('lecturers.index') }}"
                        class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50"
                    >
                        Clear
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- Desktop --}}
    <div class="hidden md:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Lecturer
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Staff No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Contact
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($lecturers as $lecturer)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($lecturers->currentPage() - 1) * $lecturers->perPage() }}

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $lecturer->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <span class="font-medium text-slate-700">
                                    {{ $lecturer->staff_no }}
                                </span>

                            </td>


                            <td class="px-6 py-4">

                                <div class="text-sm text-slate-700">
                                    {{ $lecturer->email }}
                                </div>

                                @if ($lecturer->phone)

                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $lecturer->phone }}
                                    </div>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                @if ($lecturer->status === 'Active')

                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    <a
                                        href="{{ route('lecturers.show', $lecturer) }}"
                                        title="View"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 hover:bg-blue-50"
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
                                                d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                                stroke-width="1.8"
                                            />
                                        </svg>

                                    </a>


                                    <a
                                        href="{{ route('lecturers.edit', $lecturer) }}"
                                        title="Edit"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 hover:bg-amber-50"
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
                                                d="M12 20h9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                                            />
                                        </svg>

                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('lecturers.destroy', $lecturer) }}"
                                        onsubmit="return confirm('Delete this lecturer and their user account?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50"
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
                                                    d="M4 7h16M10 11v6M14 11v6M6 7v13h12V7M9 7V4h6v3"
                                                />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No lecturers found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first lecturer to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile --}}
    <div class="md:hidden space-y-4">

        @forelse ($lecturers as $lecturer)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <div class="text-xs font-semibold text-blue-600">
                            {{ $lecturer->staff_no }}
                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $lecturer->name }}
                        </h3>

                    </div>


                    @if ($lecturer->status === 'Active')

                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            Active
                        </span>

                    @else

                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </div>


                <div class="mt-5 space-y-3 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Email
                        </span>

                        <span class="font-medium text-slate-700 text-right break-all">
                            {{ $lecturer->email }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Phone
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $lecturer->phone ?: '-' }}
                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    <a
                        href="{{ route('lecturers.show', $lecturer) }}"
                        title="View"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 bg-blue-50"
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
                                d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12z"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="2.5"
                                stroke-width="1.8"
                            />
                        </svg>
                    </a>


                    <a
                        href="{{ route('lecturers.edit', $lecturer) }}"
                        title="Edit"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 bg-amber-50"
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
                                d="M12 20h9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                            />
                        </svg>
                    </a>


                    <form
                        method="POST"
                        action="{{ route('lecturers.destroy', $lecturer) }}"
                        onsubmit="return confirm('Delete this lecturer and their user account?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            title="Delete"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 bg-red-50"
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
                                    d="M4 7h16M10 11v6M14 11v6M6 7v13h12V7M9 7V4h6v3"
                                />
                            </svg>
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No lecturers found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add your first lecturer to get started.
                </p>

            </div>

        @endforelse

    </div>


    @if ($lecturers->hasPages())

        <div class="mt-6">
            {{ $lecturers->withQueryString()->links() }}
        </div>

    @endif

</x-app-layout>
