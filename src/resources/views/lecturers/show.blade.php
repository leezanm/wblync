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
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Lecturer Information
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    View lecturer information and account details.
                </p>

            </div>


            <a
                href="{{ route('lecturers.edit', $lecturer) }}"
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
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4-1 1-4L16.5 3.5z"
                    />
                </svg>

                Edit Lecturer

            </a>

        </div>

    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Summary --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">

                <span class="text-2xl font-bold text-blue-600">
                    {{ strtoupper(substr($lecturer->name, 0, 1)) }}
                </span>

            </div>


            <div class="flex-1">

                <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $lecturer->name }}
                    </h2>


                    @if ($lecturer->status === 'Active')

                        <span class="w-fit inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            Active

                        </span>

                    @else

                        <span class="w-fit inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </div>


                <p class="text-sm text-slate-500 mt-1">
                    Staff No: {{ $lecturer->staff_no }}
                </p>

            </div>

        </div>

    </div>


    {{-- Details --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

        {{-- Lecturer Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h3 class="text-lg font-bold text-slate-800 mb-6">
                Lecturer Information
            </h3>


            <div class="space-y-5">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Staff No
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $lecturer->staff_no }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $lecturer->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Email
                    </p>

                    <p class="mt-1 font-semibold text-slate-800 break-all">
                        {{ $lecturer->email }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Phone
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $lecturer->phone ?: '-' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- User Account --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h3 class="text-lg font-bold text-slate-800 mb-6">
                User Account
            </h3>


            @if ($lecturer->user)

                <div class="space-y-5">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Login Email
                        </p>

                        <p class="mt-1 font-semibold text-slate-800 break-all">
                            {{ $lecturer->user->email }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Role
                        </p>

                        <div class="mt-2">

                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                Lecturer
                            </span>

                        </div>

                    </div>


                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Account Status
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $lecturer->status }}
                        </p>
                    </div>

                </div>

            @else

                <p class="text-sm text-red-600">
                    No user account is linked to this lecturer.
                </p>

            @endif

        </div>

    </div>


    {{-- Record Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <h3 class="text-lg font-bold text-slate-800 mb-6">
            Record Information
        </h3>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Created
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $lecturer->created_at?->format('d/m/Y h:i A') ?? '-' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Last Updated
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $lecturer->updated_at?->format('d/m/Y h:i A') ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('lecturers.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Lecturers
        </a>


        <div class="flex flex-col sm:flex-row gap-3">

            <a
                href="{{ route('lecturers.edit', $lecturer) }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
            >
                Edit Lecturer
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
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow-sm"
                >
                    Delete Lecturer
                </button>

            </form>

        </div>

    </div>

</x-app-layout>
