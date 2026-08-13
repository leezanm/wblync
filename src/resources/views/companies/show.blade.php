<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <p class="text-sm font-semibold text-blue-600">
                    {{ $company->code }}
                </p>

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $company->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Company details
                </p>

            </div>


            <a
                href="{{ route('companies.edit', $company) }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700"
            >
                Edit Company
            </a>

        </div>

    </x-slot>


    <div class="max-w-4xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="p-6 sm:p-8">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm text-slate-500">
                            Company Code
                        </p>

                        <p class="text-2xl font-bold text-blue-600 mt-1">
                            {{ $company->code }}
                        </p>

                    </div>


                    @if ($company->status)

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


            <div class="px-6 sm:px-8 pb-8">

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-7">

                    <div class="sm:col-span-2">

                        <dt class="text-sm text-slate-500">
                            Company Name
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->name }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Registration No.
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->registration_no ?: '-' }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Industry
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->industry ?: '-' }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Email
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800 break-all">
                            {{ $company->email ?: '-' }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Phone
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->phone ?: '-' }}
                        </dd>

                    </div>


                    <div class="sm:col-span-2">

                        <dt class="text-sm text-slate-500">
                            Website
                        </dt>

                        <dd class="mt-1">

                            @if ($company->website)

                                <a
                                    href="{{ $company->website }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="font-semibold text-blue-600 hover:underline break-all"
                                >
                                    {{ $company->website }}
                                </a>

                            @else

                                <span class="font-semibold text-slate-800">
                                    -
                                </span>

                            @endif

                        </dd>

                    </div>


                    <div class="sm:col-span-2">

                        <dt class="text-sm text-slate-500">
                            Address
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800 whitespace-pre-line">
                            {{ $company->address ?: '-' }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            City
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->city ?: '-' }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            State
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->state ?: '-' }}
                        </dd>

                    </div>


                    <div>

                        <dt class="text-sm text-slate-500">
                            Postcode
                        </dt>

                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $company->postcode ?: '-' }}
                        </dd>

                    </div>

                </dl>

            </div>


            <div class="px-6 sm:px-8 py-5 bg-slate-50 border-t border-slate-100">

                <a
                    href="{{ route('companies.index') }}"
                    class="text-sm font-medium text-slate-600 hover:text-slate-900"
                >
                    ← Back to Companies
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
