<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Company Contacts
                </h2>

            </div>

            <a
                href="{{ route('company-contacts.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
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

                Add Contact

            </a>

        </div>

    </x-slot>


    {{-- Page Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                List of Company Contacts
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage contact persons for industry partners.
            </p>

        </div>


        <a
            href="{{ route('company-contacts.create') }}"
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

            Add Contact

        </a>

    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">

            {{ session('success') }}

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mt-6 mb-6">

        <form
            method="GET"
            action="{{ route('company-contacts.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            <div class="md:col-span-6">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search contact, company, position or email..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            <div class="md:col-span-2">

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
                                (string) request('company_id')
                                === (string) $company->id
                            )
                        >
                            {{ $company->name }}
                        </option>

                    @endforeach

                </select>

            </div>


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


            <div class="md:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 px-5 py-3 rounded-xl bg-slate-800 text-white font-medium hover:bg-slate-900"
                >
                    Filter
                </button>

                @if(request()->hasAny([
                    'search',
                    'company_id',
                    'status'
                ]))

                    <a
                        href="{{ route('company-contacts.index') }}"
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
                            Contact
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Position
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

                    @forelse ($contacts as $contact)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $contact->name }}
                                </div>

                                @if ($contact->email)

                                    <div class="text-xs text-slate-400 mt-1">
                                        {{ $contact->email }}
                                    </div>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $contact->company->name }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $contact->company->code }}
                                </div>

                            </td>


                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $contact->position ?: '-' }}
                            </td>


                            <td class="px-6 py-4">

                                @if ($contact->email)

                                    <div class="text-sm text-slate-700">
                                        {{ $contact->email }}
                                    </div>

                                @endif

                                @if ($contact->phone)

                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $contact->phone }}
                                    </div>

                                @endif

                                @if (!$contact->email && !$contact->phone)

                                    <span class="text-sm text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                @if ($contact->status === 'Active')

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

                                    {{-- View --}}
                                    <a
                                        href="{{ route('company-contacts.show', $contact) }}"
                                        title="View"
                                        aria-label="View company contact"
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
                                        href="{{ route('company-contacts.edit', $contact) }}"
                                        title="Edit"
                                        aria-label="Edit company contact"
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
                                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                            />

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('company-contacts.destroy', $contact) }}"
                                        onsubmit="return confirm('Delete this company contact?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            aria-label="Delete company contact"
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
                                                    d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
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
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No company contacts found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first company contact to get started.
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

        @forelse ($contacts as $contact)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <div class="text-sm font-bold text-blue-600">
                            {{ $contact->company->code }}
                        </div>

                        <h3 class="font-semibold text-slate-800 mt-1">
                            {{ $contact->name }}
                        </h3>

                        @if ($contact->position)

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $contact->position }}
                            </p>

                        @endif

                    </div>


                    @if ($contact->status === 'Active')

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
                            {{ $contact->company->name }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Email
                        </span>

                        <span class="font-medium text-slate-700 text-right break-all">
                            {{ $contact->email ?: '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Phone
                        </span>

                        <span class="font-medium text-slate-700 text-right">
                            {{ $contact->phone ?: '-' }}
                        </span>

                    </div>

                </div>


                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    {{-- View --}}
                    <a
                        href="{{ route('company-contacts.show', $contact) }}"
                        title="View"
                        aria-label="View company contact"
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
                        href="{{ route('company-contacts.edit', $contact) }}"
                        title="Edit"
                        aria-label="Edit company contact"
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
                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                            />

                        </svg>

                    </a>


                    {{-- Delete --}}
                    <form
                        method="POST"
                        action="{{ route('company-contacts.destroy', $contact) }}"
                        onsubmit="return confirm('Delete this company contact?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            title="Delete"
                            aria-label="Delete company contact"
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
                                    d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                />

                            </svg>

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No company contacts found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add your first company contact to get started.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($contacts->hasPages())

        <div class="mt-6">

            {{ $contacts->withQueryString()->links() }}

        </div>

    @endif

</x-app-layout>
