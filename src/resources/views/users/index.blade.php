<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Users
                </h2>

            </div>



            @can('create users')
                <a
                    href="{{ route('users.create') }}"
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

                    Add User

                </a>
            @endcan
        </div>

    </x-slot>


    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                List of Users
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage system users and their assigned roles.
            </p>

        </div>

    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Errors --}}
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
            action="{{ route('users.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4"
        >

            {{-- Search --}}
            <div class="md:col-span-7">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search name or email..."
                    class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Role --}}
            <div class="md:col-span-3">

                <select
                    name="role"
                    class="w-full py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Roles
                    </option>

                    @foreach ($roles as $role)

                        <option
                            value="{{ $role->name }}"
                            @selected(request('role') === $role->name)
                        >
                            {{ $role->name }}
                        </option>

                    @endforeach

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


                @if (request()->hasAny(['search', 'role']))

                    <a
                        href="{{ route('users.index') }}"
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
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Role
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Created
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($users as $user)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Number --}}
                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}

                            </td>


                            {{-- User --}}
                            <td class="px-6 py-4">

                                <div class="font-bold text-blue-600">
                                    {{ $user->name }}
                                </div>

                                <div class="text-sm text-slate-500 mt-1">
                                    {{ $user->email }}
                                </div>

                            </td>


                            {{-- Role --}}
                            <td class="px-6 py-4">

                                @forelse ($user->roles as $role)

                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold mr-1 mb-1">

                                        {{ $role->name }}

                                    </span>

                                @empty

                                    <span class="text-sm text-slate-400">
                                        No role
                                    </span>

                                @endforelse

                            </td>


                            {{-- Created --}}
                            <td class="px-6 py-4 text-sm text-slate-600">

                                {{ $user->created_at?->format('d/m/Y') ?? '-' }}

                            </td>


                            {{-- Action --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('users.show', $user) }}"
                                        title="View"
                                        aria-label="View user"
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

                                    @can('view users')
                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            title="Edit"
                                            aria-label="Edit user"
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
                                    @endcan

                                    {{-- Delete --}}

                                    @can('delete users')
                                        @if ($user->id !== auth()->id())

                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('Delete this user?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Delete"
                                                    aria-label="Delete user"
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

                                        @endif
                                    @endcan

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16 text-center"
                            >

                                <h3 class="font-semibold text-slate-700">
                                    No users found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first user to get started.
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

        @forelse ($users as $user)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <h3 class="font-semibold text-slate-800">
                            {{ $user->name }}
                        </h3>

                        <p class="text-sm text-slate-500 mt-1 break-all">
                            {{ $user->email }}
                        </p>

                    </div>

                </div>


                {{-- Roles --}}
                <div class="mt-4">

                    @forelse ($user->roles as $role)

                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold mr-1 mb-1">

                            {{ $role->name }}

                        </span>

                    @empty

                        <span class="text-sm text-slate-400">
                            No role
                        </span>

                    @endforelse

                </div>


                <div class="flex justify-between gap-4 mt-4 text-sm">

                    <span class="text-slate-500">
                        Created
                    </span>

                    <span class="font-medium text-slate-700">
                        {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                    </span>

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-slate-100">

                    {{-- View --}}
                    <a
                        href="{{ route('users.show', $user) }}"
                        title="View"
                        aria-label="View user"
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
                        href="{{ route('users.edit', $user) }}"
                        title="Edit"
                        aria-label="Edit user"
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
                    @if ($user->id !== auth()->id())

                        <form
                            method="POST"
                            action="{{ route('users.destroy', $user) }}"
                            onsubmit="return confirm('Delete this user?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                title="Delete"
                                aria-label="Delete user"
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

                    @endif

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No users found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Add your first user to get started.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($users->hasPages())

        <div class="mt-6">

            {{ $users->withQueryString()->links() }}

        </div>

    @endif

</x-app-layout>
