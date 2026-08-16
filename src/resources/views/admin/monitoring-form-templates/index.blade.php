<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Monitoring Form Setup
                </h2>

                {{-- <p class="text-sm text-slate-500 mt-1">
                    Manage the monitoring form content and versions.
                </p> --}}

            </div>

        </div>

    </x-slot>


    @if (session('success'))

        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>

    @endif


    {{-- Active Version --}}
    @if ($activeTemplate)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-3">

                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $activeTemplate->name }}
                        </h3>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            Active
                        </span>

                    </div>

                    <p class="text-sm text-slate-500 mt-2">
                        Version {{ $activeTemplate->version }}
                    </p>

                </div>


                <div class="flex gap-3">

                    <a
                        href="{{ route(
                            'admin.monitoring-form-templates.edit',
                            $activeTemplate
                        ) }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold"
                    >
                        View Form
                    </a>

                    <form
                        method="POST"
                        action="{{ route(
                            'admin.monitoring-form-templates.create'
                        ) }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700"
                        >
                            Create New Version
                        </button>

                    </form>

                </div>

            </div>

        </div>

    @endif


    {{-- Version History --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h3 class="text-xl font-bold text-slate-800">
                Form Versions
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Previous versions are preserved for historical records.
            </p>

        </div>


        <div class="divide-y divide-slate-100">

            @forelse ($templates as $template)

                <div class="p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <div class="flex items-center gap-3">

                            <h4 class="font-bold text-slate-800">
                                Version {{ $template->version }}
                            </h4>

                            @if ($template->status === 'Active')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Active
                                </span>

                            @elseif ($template->status === 'Draft')

                                <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                    Draft
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-semibold">
                                    Archived
                                </span>

                            @endif

                        </div>

                        <p class="text-sm text-slate-500 mt-1">
                            {{ $template->name }}
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

                        @if ($template->status === 'Draft')

                            <a
                                href="{{ route(
                                    'admin.monitoring-form-templates.edit',
                                    $template
                                ) }}"
                                class="px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold"
                            >
                                Edit
                            </a>


                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.monitoring-form-templates.activate',
                                    $template
                                ) }}"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    onclick="return confirm('Activate this version? The current active version will be archived.')"
                                    class="px-4 py-2.5 rounded-xl bg-green-600 text-white text-sm font-semibold"
                                >
                                    Activate
                                </button>

                            </form>

                        @else

                            <a
                                href="{{ route(
                                    'admin.monitoring-form-templates.edit',
                                    $template
                                ) }}"
                                class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold"
                            >
                                View
                            </a>

                        @endif

                    </div>

                </div>

            @empty

                <div class="p-12 text-center text-sm text-slate-500">
                    No monitoring form versions found.
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
