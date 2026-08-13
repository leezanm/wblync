<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Company Contact Details
                </h2>

            </div>


            <a
                href="{{ route('company-contacts.edit', $companyContact) }}"
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
                        d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                    />
                </svg>

                Edit Contact

            </a>

        </div>

    </x-slot>


    {{-- Page Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Contact Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                View company contact details.
            </p>

        </div>

    </div>


    {{-- Contact Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

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
                        d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
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
                    Contact Information
                </h3>

                <p class="text-sm text-slate-500">
                    Contact person details.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Name --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Contact Name
                </p>

                <p class="mt-2 font-bold text-slate-800">
                    {{ $companyContact->name }}
                </p>

            </div>


            {{-- Position --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Position
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $companyContact->position ?: '-' }}
                </p>

            </div>


            {{-- Status --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Status
                </p>

                <div class="mt-2">

                    @if ($companyContact->status === 'Active')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            Active

                        </span>

                    @else

                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">

                            Inactive

                        </span>

                    @endif

                </div>

            </div>


            {{-- Email --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Email
                </p>

                <p class="mt-2 font-semibold text-slate-800 break-all">
                    {{ $companyContact->email ?: '-' }}
                </p>

            </div>


            {{-- Phone --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Phone
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $companyContact->phone ?: '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Company Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mt-6">

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
                        d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2M9 11h2M9 15h2M15 7h2M15 11h2M15 15h2"
                    />
                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Company Information
                </h3>

                <p class="text-sm text-slate-500">
                    Industry partner associated with this contact.
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Company Code --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Company Code
                </p>

                <p class="mt-2 font-bold text-blue-600">
                    {{ $companyContact->company->code }}
                </p>

            </div>


            {{-- Company Name --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Company Name
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $companyContact->company->name }}
                </p>

            </div>


            {{-- Industry --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Industry
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $companyContact->company->industry ?: '-' }}
                </p>

            </div>


            {{-- Registration --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Registration No.
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $companyContact->company->registration_no ?: '-' }}
                </p>

            </div>


            {{-- Company Email --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Company Email
                </p>

                <p class="mt-2 font-semibold text-slate-800 break-all">
                    {{ $companyContact->company->email ?: '-' }}
                </p>

            </div>


            {{-- Company Phone --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Company Phone
                </p>

                <p class="mt-2 font-semibold text-slate-800">
                    {{ $companyContact->company->phone ?: '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 mb-6">

        <a
            href="{{ route('company-contacts.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
        >
            ← Back to Company Contacts
        </a>


        <a
            href="{{ route('company-contacts.edit', $companyContact) }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
        >
            Edit Contact
        </a>

    </div>

</x-app-layout>
