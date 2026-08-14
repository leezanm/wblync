<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    User Details
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    View user information and assigned role.
                </p>

            </div>


            <a
                href="{{ route('users.edit', $user) }}"
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
                        stroke-width="1.8"
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                    />
                </svg>

                Edit User

            </a>

        </div>

    </x-slot>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- User Summary --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            {{-- Avatar --}}
            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">

                <span class="text-2xl font-bold text-blue-600">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>

            </div>


            <div class="min-w-0">

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    User
                </p>

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $user->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1 break-all">
                    {{ $user->email }}
                </p>

            </div>

        </div>

    </div>


    {{-- Information --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">


        {{-- Basic Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">

                    <svg
                        class="w-5 h-5 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4.5 20.25a7.5 7.5 0 0115 0"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Basic Information
                    </h3>

                    <p class="text-sm text-slate-500">
                        User account details.
                    </p>

                </div>

            </div>


            <div class="space-y-5">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $user->name }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Email
                    </p>

                    <p class="mt-1 font-semibold text-slate-800 break-all">
                        {{ $user->email }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Account Created
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $user->created_at?->format('d/m/Y h:i A') ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Last Updated
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $user->updated_at?->format('d/m/Y h:i A') ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Roles --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">

                    <svg
                        class="w-5 h-5 text-indigo-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12l2 2 4-4"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Assigned Role
                    </h3>

                    <p class="text-sm text-slate-500">
                        Role assigned to this user.
                    </p>

                </div>

            </div>


            <div class="space-y-4">

                @forelse ($user->roles as $role)

                    <div class="flex items-center justify-between gap-4 p-4 rounded-xl bg-blue-50 border border-blue-100">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                    />

                                </svg>

                            </div>

                            <span class="font-semibold text-blue-700">
                                {{ $role->name }}
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="rounded-xl bg-slate-50 border border-slate-100 p-5">

                        <p class="text-sm text-slate-400">
                            No role assigned.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('users.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Users
        </a>


        <div class="flex flex-col sm:flex-row gap-3">

            <a
                href="{{ route('users.edit', $user) }}"
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
                        stroke-width="1.8"
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1-4L16.5 3.5z"
                    />
                </svg>

                Edit User

            </a>


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
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow-sm"
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

                        Delete User

                    </button>

                </form>

            @endif

        </div>

    </div>

</x-app-layout>
