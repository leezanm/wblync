<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                Monitoring
            </p>

            {{-- <h2 class="text-2xl font-bold text-slate-800 mt-1">
                Lawatan {{ $monitoringNo }}
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                {{ $student->name }}
            </p> --}}
        </div>
    </x-slot>

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">
            <p class="font-semibold text-red-700">Please review the following information:</p>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('lecturer.monitoring.store', ['student' => $student, 'monitoringNo' => $monitoringNo]) }}">
        @csrf

        {{-- MONITORING INFORMATION --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

            <div class="flex items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Monitoring Information</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Please complete the monitoring visit details.
                    </p>
                </div>

                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                    Visit {{ $monitoringNo }} / 3
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Student Name
                    </label>
                    <input type="text" value="{{ $student->name }}" readonly
                        class="w-full rounded-xl bg-slate-100 border-slate-200 text-slate-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Student No.
                    </label>
                    <input type="text" value="{{ $student->student_no ?? '-' }}" readonly
                        class="w-full rounded-xl bg-slate-100 border-slate-200 text-slate-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Monitoring
                    </label>
                    <input type="text" value="Visit {{ $monitoringNo }}" readonly
                        class="w-full rounded-xl bg-slate-100 border-slate-200 text-slate-600">
                </div>

                <div>
                    <label for="monitoring_date" class="block text-sm font-semibold text-slate-700 mb-2">
                        Monitoring Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="monitoring_date" name="monitoring_date"
                        value="{{ old('monitoring_date') }}" required
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Reported In
                    </label>
                    <label class="inline-flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="reported_to" value="1"
                            {{ old('reported_to') ? 'checked' : '' }}
                            class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-700">Student has reported in</span>
                    </label>
                </div>

                <div>
                    <label for="reported_at" class="block text-sm font-semibold text-slate-700 mb-2">
                        Reported In Time
                    </label>
                    <input type="time" id="reported_at" name="reported_at"
                        value="{{ old('reported_at') }}"
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

            </div>
        </div>

        {{-- DYNAMIC FORM --}}
        @foreach ($template->sections as $section)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

                <div class="p-6 bg-slate-50 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shrink-0">
                            {{ $section->section_no }}
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800">
                                {{ $section->title }}
                            </h3>
                            <p class="text-xs text-slate-400 mt-1">
                                Please choose the most appropriate rating.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-10">

                    @foreach ($section->items as $item)

                        <div>

                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                <label class="block text-base font-bold text-slate-800">
                                    {{ $item->label }}

                                    @if ($item->item_type !== 'textarea')
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                @if ($item->item_type !== 'textarea')
                                    <span class="shrink-0 text-xs font-medium text-slate-400">
                                        Select one
                                    </span>
                                @endif
                            </div>

                            @if ($item->description)
                                <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                                    {{ $item->description }}
                                </p>
                            @endif


                            {{-- RATING --}}
                            @if ($item->item_type === 'rating')

                                <div class="mt-4 space-y-3">

                                    @foreach ($item->options as $option)

                                        <label class="block cursor-pointer">

                                            <input
                                                type="radio"
                                                name="responses[{{ $item->id }}][option_id]"
                                                value="{{ $option->id }}"
                                                required
                                                class="peer sr-only"
                                            >

                                            <div class="
                                                flex items-start gap-4
                                                rounded-xl border border-slate-200 bg-white p-4
                                                transition
                                                hover:border-blue-300 hover:bg-slate-50
                                                peer-checked:border-blue-500
                                                peer-checked:bg-blue-50
                                                peer-checked:ring-1
                                                peer-checked:ring-blue-500
                                            ">

                                                <div class="
                                                    mt-0.5 flex h-6 w-6 shrink-0
                                                    items-center justify-center rounded-full
                                                    border-2 border-slate-300 bg-white
                                                    transition
                                                    peer-checked:border-blue-600
                                                    peer-checked:bg-blue-600
                                                ">
                                                    <span class="h-2.5 w-2.5 rounded-full bg-transparent"></span>
                                                </div>

                                                <div class="min-w-0 flex-1">
                                                    <p class="font-bold text-slate-800">
                                                        {{ $option->label }}
                                                    </p>

                                                    @if ($option->description)
                                                        <p class="mt-1 text-sm leading-relaxed text-slate-500">
                                                            {{ $option->description }}
                                                        </p>
                                                    @endif
                                                </div>

                                            </div>
                                        </label>

                                    @endforeach

                                </div>


                            {{-- YES / NO --}}
                            @elseif ($item->item_type === 'yes_no')

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">

                                    @foreach ($item->options as $option)

                                        <label class="block cursor-pointer">

                                            <input
                                                type="radio"
                                                name="responses[{{ $item->id }}][option_id]"
                                                value="{{ $option->id }}"
                                                required
                                                class="peer sr-only"
                                            >

                                            <div class="
                                                flex items-center gap-3
                                                rounded-xl border border-slate-200 bg-white p-4
                                                transition
                                                hover:border-blue-300 hover:bg-slate-50
                                                peer-checked:border-blue-500
                                                peer-checked:bg-blue-50
                                                peer-checked:ring-1
                                                peer-checked:ring-blue-500
                                            ">

                                                <div class="
                                                    flex h-6 w-6 shrink-0 items-center justify-center
                                                    rounded-full border-2 border-slate-300 bg-white
                                                    peer-checked:border-blue-600
                                                    peer-checked:bg-blue-600
                                                ">
                                                    <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                                                </div>

                                                <span class="font-bold text-slate-800">
                                                    {{ $option->label }}
                                                </span>

                                            </div>
                                        </label>

                                    @endforeach

                                </div>

                                <div class="mt-4">
                                    <label for="answer-{{ $item->id }}"
                                        class="block text-sm font-semibold text-slate-700 mb-2">
                                        Comment
                                        <span class="text-slate-400 font-normal">(optional)</span>
                                    </label>

                                    <textarea
                                        id="answer-{{ $item->id }}"
                                        name="responses[{{ $item->id }}][answer]"
                                        rows="3"
                                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Enter comments if any..."
                                    >{{ old("responses.{$item->id}.answer") }}</textarea>
                                </div>


                            {{-- TEXTAREA --}}
                            @elseif ($item->item_type === 'textarea')

                                <div class="mt-4">
                                    <textarea
                                        id="answer-{{ $item->id }}"
                                        name="responses[{{ $item->id }}][answer]"
                                        rows="5"
                                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Enter overall comments..."
                                    >{{ old("responses.{$item->id}.answer") }}</textarea>
                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>
            </div>

        @endforeach


        {{-- ACTIONS --}}
        <div class="sticky bottom-4 z-20 flex items-center justify-end gap-3 mb-10">

            <a
                href="{{ route('lecturer.monitoring.student', $student) }}"
                class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold shadow-sm hover:bg-slate-50"
            >
                Cancel
            </a>

            <button
                type="submit"
                onclick="return confirm('Please ensure all assessments are completed before saving the monitoring form.')"
                class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow-lg hover:bg-blue-700 transition"
            >
                Save Monitoring
            </button>

        </div>

    </form>

</x-app-layout>
