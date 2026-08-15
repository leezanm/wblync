<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Industry Mentor Details
                </h2>



            </div>




        </div>

    </x-slot>

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 ">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Industry Mentor Details
                </h2>



            </div>


            <a
                href="{{ route('industry-supervisors.edit', $industrySupervisor) }}"
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

                Edit Industry Mentor

            </a>

        </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 mt-6 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Supervisor Summary --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mt-6 p-6">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            {{-- Avatar --}}
            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">

                <span class="text-2xl font-bold text-blue-600">
                    {{ strtoupper(substr($industrySupervisor->name ?? '-', 0, 1)) }}
                </span>

            </div>


            <div class="min-w-0 flex-1">

                <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $industrySupervisor->name ?? '-' }}
                    </h2>


                    @if ($industrySupervisor->status === 'Active')

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


                @if ($industrySupervisor->position)

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $industrySupervisor->position }}
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- Information --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">


        {{-- Supervisor Information --}}
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
                        Industry Mentor Information
                    </h3>

                    <p class="text-sm text-slate-500">
                        Contact details.
                    </p>

                </div>

            </div>


            <div class="space-y-5">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $industrySupervisor->name ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Position
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $industrySupervisor->position ?: '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Email
                    </p>

                    <p class="mt-1 font-semibold text-slate-800 break-all">
                        {{ $industrySupervisor->email ?: '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Phone
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $industrySupervisor->phone ?: '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Company Information --}}
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
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M8 9h1M8 12h1M15 9h1M15 12h1"
                        />

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Company
                    </h3>

                    <p class="text-sm text-slate-500">
                        Company and liaison contact information.
                    </p>

                </div>

            </div>



                <div class="rounded-xl bg-slate-50 border border-slate-100 p-5">

                    <div class="text-sm font-bold text-blue-600">
                        {{ $industrySupervisor->company?->code ?? 'No Info' }}
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mt-1">
                        {{ $industrySupervisor->company?->name ?? '' }}
                    </h3>

                </div>
        </div>

    </div>


    {{-- Account Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-slate-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 8v4l3 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />

                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Record Information
                </h3>

                <p class="text-sm text-slate-500">
                    Record history.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Created
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $industrySupervisor->created_at?->format('d/m/Y h:i A') ?? '-' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Last Updated
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $industrySupervisor->updated_at?->format('d/m/Y h:i A') ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('industry-supervisors.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Industry Supervisors
        </a>


        <div class="flex flex-col sm:flex-row gap-3">

            <a
                href="{{ route('industry-supervisors.edit', $industrySupervisor) }}"
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

                Edit Supervisor

            </a>


            <form
                method="POST"
                action="{{ route('industry-supervisors.destroy', $industrySupervisor) }}"
                onsubmit="return confirm('Delete this industry supervisor?');"
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

                    Delete Supervisor

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
