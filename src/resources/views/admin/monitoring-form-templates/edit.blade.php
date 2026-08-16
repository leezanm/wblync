<x-app-layout>

    <x-slot name="header">

        <div>

            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                Monitoring Form Setup
            </p>

            {{-- <h2 class="text-2xl font-bold text-slate-800 mt-1">
                Version {{ $monitoringFormTemplate->version }}
            </h2> --}}

        </div>

    </x-slot>


    <form
        method="POST"
        action="{{ route(
            'admin.monitoring-form-templates.update',
            $monitoringFormTemplate
        ) }}"
    >

        @csrf
        @method('PUT')


        <div class="space-y-6">

            @foreach (
                $monitoringFormTemplate->sections
                as $section
            )

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Section Header --}}
                    <div class="p-6 bg-slate-50 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <span class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold">
                                {{ $section->section_no }}
                            </span>

                            <div>

                                <h3 class="font-bold text-slate-800">
                                    {{ $section->title }}
                                </h3>

                                <p class="text-xs text-slate-400 mt-1">
                                    Fixed section structure
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Items --}}
                    <div class="p-6 space-y-8">

                        @foreach ($section->items as $item)

                            <div class="border border-slate-200 rounded-2xl p-5">

                                <div class="flex items-center gap-2 mb-4">

                                    <span class="text-xs font-semibold text-blue-600 uppercase">
                                        Editable Content
                                    </span>

                                </div>


                                {{-- Label --}}
                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Question / Item
                                    </label>

                                    <textarea
                                        name="items[{{ $item->id }}][label]"
                                        rows="2"
                                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                    >{{ old(
                                        "items.{$item->id}.label",
                                        $item->label
                                    ) }}</textarea>

                                </div>


                                {{-- Description --}}
                                @if ($item->item_type !== 'textarea')

                                    <div class="mt-4">

                                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                                            Description / Guidance
                                        </label>

                                        <textarea
                                            name="items[{{ $item->id }}][description]"
                                            rows="3"
                                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                        >{{ old(
                                            "items.{$item->id}.description",
                                            $item->description
                                        ) }}</textarea>

                                    </div>

                                @endif


                                {{-- Options --}}
                                @if ($item->options->count())

                                    <div class="mt-6">

                                        <p class="text-sm font-semibold text-slate-700 mb-3">
                                            Rating / Options
                                        </p>

                                        <div class="space-y-4">

                                            @foreach ($item->options as $option)

                                                <div class="rounded-xl bg-slate-50 border border-slate-200 p-4">

                                                    <div class="flex items-center gap-2 mb-3">

                                                        <span class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600">
                                                            {{ $option->label }}
                                                        </span>

                                                    </div>


                                                    <input
                                                        type="text"
                                                        name="options[{{ $option->id }}][label]"
                                                        value="{{ old(
                                                            "options.{$option->id}.label",
                                                            $option->label
                                                        ) }}"
                                                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                                    >


                                                    @if ($item->item_type === 'rating')

                                                        <textarea
                                                            name="options[{{ $option->id }}][description]"
                                                            rows="2"
                                                            class="w-full mt-2 rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                                            placeholder="Description for this rating"
                                                        >{{ old(
                                                            "options.{$option->id}.description",
                                                            $option->description
                                                        ) }}</textarea>

                                                    @endif

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>

                                @endif


                                {{-- Locked info --}}
                                <div class="mt-5 pt-4 border-t border-slate-100">

                                    <p class="text-xs text-slate-400">
                                        🔒 Structure locked — Item type, order and option count cannot be changed.
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach


            {{-- Action --}}
            <div class="sticky bottom-4 flex justify-end">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow-lg hover:bg-blue-700"
                >
                    Save Changes
                </button>

            </div>

        </div>

    </form>

</x-app-layout>
