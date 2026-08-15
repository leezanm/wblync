<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Industry Mentors
                </h2>

            </div>




        </div>

    </x-slot>


    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                List of Industry Mentors
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage industry mentors and company assignments.
            </p>

        </div>
          <a
                href="{{ route('industry-supervisors.create') }}"
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

                Add Supervisor

            </a>

    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error --}}
    @if ($errors->any())

        <div class="mb-6 mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-700">

            <ul class="list-disc list-inside space-y-1">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mt-6 mb-6">

        <form
            method="GET"
            action="{{ route('industry-supervisors.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="md:col-span-5">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search supervisor, email, phone or company..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Company --}}
            <div class="md:col-span-3">

                <select
                    name="company_id"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Companies
                    </option>

                    @foreach ($companies as $company)

                        <option
                            value="{{ $company->id }}"
                            @selected(
                                (string) request('company_id') ===
                                (string) $company->id
                            )
                        >
                            {{ $company->code }} - {{ $company->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div class="md:col-span-2">

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


            {{-- Buttons --}}
            <div class="md:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900 transition"
                >
                    Filter
                </button>


                @if (request()->hasAny([
                    'search',
                    'company_id',
                    'status',
                ]))

                    <a
                        href="{{ route('industry-supervisors.index') }}"
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
                            Supervisor
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Company
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

                    @forelse ($supervisors as $supervisor)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($supervisors->currentPage() - 1) * $supervisors->perPage() }}

                            </td>


                            {{-- Supervisor --}}
                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $supervisor->name ?? '-' }}
                                </div>

                                @if ($supervisor->position)

                                    <div class="text-sm text-slate-500 mt-1">
                                        {{ $supervisor->position }}
                                    </div>

                                @endif

                            </td>


                            {{-- Company --}}
                            <td class="px-6 py-4">


                                    <div class="font-semibold text-slate-700">
                                        {{ $supervisor->company?->name }}
                                    </div>

                                    <div class="text-xs text-blue-600 mt-1">
                                        {{ $supervisor->company?->code }}
                                    </div>



                            </td>


                            {{-- Contact --}}
                            <td class="px-6 py-4">

                                @if ($supervisor->email)

                                    <div class="text-sm text-slate-700">
                                        {{ $supervisor->email }}
                                    </div>

                                @endif

                                @if ($supervisor->phone)

                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $supervisor->phone }}
                                    </div>

                                @endif

                                @if (!$supervisor->email && !$supervisor->phone)

                                    <span class="text-sm text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if ($supervisor->status === 'Active')

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


                            {{-- Action --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('industry-supervisors.show', $supervisor) }}"
                                        title="View"
                                        aria-label="View supervisor"
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


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('industry-supervisors.edit', $supervisor) }}"
                                        title="Edit"
                                        aria-label="Edit supervisor"
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


                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('industry-supervisors.destroy', $supervisor) }}"
                                        onsubmit="return confirm('Delete this industry supervisor?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            aria-label="Delete supervisor"
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
                                    No industry supervisors found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first industry supervisor to get started.
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

        @forelse ($supervisors as $supervisor)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">



                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $supervisor->name ?? '-' }}
                        </h3>

                        @if ($supervisor->position)

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $supervisor->position }}
                            </p>

                        @endif

                    </div>


                    @if ($supervisor->status === 'Active')

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
                            Company
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{-- {{ $supervisor->company?->name ?? '-' }} --}}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Email
                        </span>

                        <span class="font-medium text-slate-700 text-right break-all">
                            {{ $supervisor->email ?: '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Phone
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $supervisor->phone ?: '-' }}
                        </span>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    {{-- View --}}
                    <a
                        href="{{ route('industry-supervisors.show', $supervisor) }}"
                        title="View"
                        aria-label="View supervisor"
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


                    {{-- Edit --}}
                    <a
                        href="{{ route('industry-supervisors.edit', $supervisor) }}"
                        title="Edit"
                        aria-label="Edit supervisor"
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


                    {{-- Delete --}}
                    <form
                        method="POST"
                        action="{{ route('industry-supervisors.destroy', $supervisor) }}"
                        onsubmit="return confirm('Delete this industry supervisor?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            title="Delete"
                            aria-label="Delete supervisor"
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
                    No industry supervisors found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add your first industry supervisor to get started.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($supervisors->hasPages())

        <div class="mt-6">

            {{ $supervisors->withQueryString()->links() }}

        </div>

    @endif

</x-app-layout>
