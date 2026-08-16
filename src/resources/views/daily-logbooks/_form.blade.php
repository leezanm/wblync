<div class="space-y-6">

    <input
        type="hidden"
        name="placement_id"
        value="{{ old('placement_id', $placement->id) }}"
    >

    <div>

        <h3 class="text-lg font-bold text-slate-800">
            Daily Logbook Information
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Record the student's daily WBL activities and learning outcomes.
        </p>

    </div>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Placement --}}
        <div class="md:col-span-2 rounded-xl bg-slate-50 border border-slate-200 p-2">

            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                Current Placement
            </p>

            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Student
                    </p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $placement->student?->name ?? '-' }}
                    </p>
                    <p class="text-slate-500">
                        {{ $placement->student?->student_no ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Academic Session
                    </p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $placement->academicSession?->name ?? '-' }}
                    </p>
                    <p class="text-slate-500">
                        {{ $placement->academicSession?->start_date?->format('d M Y') ?? '-' }}
                        -
                        {{ $placement->academicSession?->end_date?->format('d M Y') ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Company
                    </p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $placement->company?->code ? $placement->company->code . ' - ' : '' }}{{ $placement->company?->name ?? '-' }}
                    </p>
                    <p class="text-slate-500">
                        {{ $placement->company?->industry ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Industry Supervisor
                    </p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $placement->industrySupervisor?->name ?? '-' }}
                    </p>
                    <p class="text-slate-500">
                        {{ $placement->industrySupervisor?->position ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Programme / Class
                    </p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $placement->student?->classRoom?->programme?->name ?? '-' }}
                    </p>
                    <p class="text-slate-500">
                        {{ $placement->student?->classRoom?->name ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Placement Period
                    </p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $placement->start_date?->format('d M Y') ?? '-' }}
                        -
                        {{ $placement->end_date?->format('d M Y') ?? '-' }}
                    </p>
                    <p class="text-slate-500">
                        Status: {{ $placement->status ?? '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div>
             {{-- Log Date --}}
        <div class="mb-2">
            <label
                for="log_date"
                class="block text-sm font-semibold text-slate-700 mb-2"
            >
                Date
            </label>

            <input
                type="date"
                id="log_date"
                name="log_date"
                value="{{ old('log_date', now()->toDateString()) }}"
                required
                class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3"
            >

            @error('log_date')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Work Status --}}
        <div class="mb-2">
            <label
                for="work_status"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Working Status <span class="text-red-500">*</span>
            </label>

            <select
                id="work_status"
                name="work_status"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                @foreach ([
                    'Working',
                    'Off Day',
                    'Public Holiday',
                    'Leave',
                    'Medical Leave',
                ] as $workStatus)
                    <option
                        value="{{ $workStatus }}"
                        @selected(
                            old(
                                'work_status',
                                $dailyLogbook->work_status ?? 'Working'
                            ) === $workStatus
                        )
                    >
                        {{ $workStatus }}
                    </option>
                @endforeach
            </select>

            @error('work_status')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Working Hours --}}
        <div class="mb-2">

            <label
                for="working_hours"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Working Hours
            </label>

            <input
                type="number"
                id="working_hours"
                name="working_hours"
                value="{{ old(
                    'working_hours',
                    $dailyLogbook->working_hours ?? ''
                ) }}"
                min="0"
                max="24"
                step="0.25"
                placeholder="e.g. 8"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('working_hours')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Status --}}
        <div class="mb-2">

            <label
                for="status"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Status <span class="text-red-500">*</span>
            </label>

            <select
                id="status"
                name="status"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

                @foreach ([
                    'Draft',
                    'Submitted',
                    'Approved',
                    'Rejected',
                ] as $status)

                    <option
                        value="{{ $status }}"
                        @selected(
                            old(
                                'status',
                                $dailyLogbook->status ?? 'Draft'
                            ) === $status
                        )
                    >
                        {{ $status }}
                    </option>

                @endforeach

            </select>

            @error('status')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        </div>


        {{-- Activity --}}
        <div class="md:col-span-3">

            <label
                for="activity"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Daily Activity <span class="text-red-500">*</span>
            </label>

            <textarea
                id="activity"
                name="activity"
                rows="5"
                required
                placeholder="Describe the activities performed today..."
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >{{ old('activity', $dailyLogbook->activity ?? '') }}</textarea>

            @error('activity')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Learning Outcome --}}
        <div class="md:col-span-3">

            <label
                for="learning_outcome"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Learning Outcome
            </label>

            <textarea
                id="learning_outcome"
                name="learning_outcome"
                rows="4"
                placeholder="Describe the knowledge, skills or experience gained..."
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >{{ old(
                'learning_outcome',
                $dailyLogbook->learning_outcome ?? ''
            ) }}</textarea>

            @error('learning_outcome')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Weekend Summary --}}
        <div class="md:col-span-3 rounded-2xl border border-slate-200 bg-slate-50/80 p-5">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                <div>
                    <h4 class="text-sm font-semibold text-slate-800">
                        Weekly Summary
                    </h4>
                    <p class="mt-1 text-sm text-slate-500">
                        Tick the checkbox below if you want to include a weekend / weekly summary for this logbook entry.
                    </p>
                </div>

                <div class="shrink-0">
                    <input
                        type="hidden"
                        name="has_weekend_summary"
                        value="0"
                    >

                    <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
                        <input
                            type="checkbox"
                            id="has_weekend_summary"
                            name="has_weekend_summary"
                            value="1"
                            @checked(old('has_weekend_summary', filled($dailyLogbook->weekly_summary ?? null)))
                            class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                        >
                        <span class="text-sm font-medium text-slate-700">
                            Enable weekend summary
                        </span>
                    </label>
                </div>

            </div>

            <div class="mt-4">
                <label
                    for="weekly_summary"
                    class="mb-2 block text-sm font-medium text-slate-700"
                >
                    Weekend Summary
                </label>

                <textarea
                    id="weekly_summary"
                    name="weekly_summary"
                    rows="4"
                    placeholder="Summarise key activities, progress, challenges or highlights for the week / weekend..."
                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                >{{ old('weekly_summary', $dailyLogbook->weekly_summary ?? '') }}</textarea>

                <p class="mt-2 text-xs text-slate-400">
                    This field is only enabled when the weekend summary checkbox is ticked.
                </p>

                @error('weekly_summary')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror
            </div>

        </div>


        {{-- Remarks --}}
        <div class="md:col-span-3">

            <label
                for="remarks"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Remarks
            </label>

            <textarea
                id="remarks"
                name="remarks"
                rows="4"
                placeholder="Additional remarks..."
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >{{ old(
                'remarks',
                $dailyLogbook->remarks ?? ''
            ) }}</textarea>

            @error('remarks')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>

</div>

<script>
    (function () {
        const workStatusSelect = document.getElementById('work_status');
        const activityTextarea = document.getElementById('activity');
        const weekendSummaryCheckbox = document.getElementById('has_weekend_summary');
        const weekendSummaryTextarea = document.getElementById('weekly_summary');
        const nonWorkingStatuses = [
            'Off Day',
            'Public Holiday',
            'Leave',
            'Medical Leave',
        ];

        if (!workStatusSelect || !activityTextarea) {
            return;
        }

        const applyWorkStatusActivity = () => {
            const workStatus = workStatusSelect.value;
            const isNonWorking = nonWorkingStatuses.includes(workStatus);

            if (isNonWorking) {
                activityTextarea.value = workStatus;
                activityTextarea.readOnly = true;
                return;
            }

            activityTextarea.readOnly = false;

            if (nonWorkingStatuses.includes(activityTextarea.value)) {
                activityTextarea.value = '';
            }
        };

        workStatusSelect.addEventListener('change', applyWorkStatusActivity);
        applyWorkStatusActivity();

        if (weekendSummaryCheckbox && weekendSummaryTextarea) {
            const applyWeekendSummaryState = () => {
                const enabled = weekendSummaryCheckbox.checked;

                weekendSummaryTextarea.disabled = !enabled;
                weekendSummaryTextarea.readOnly = !enabled;
                weekendSummaryTextarea.classList.toggle('bg-slate-100', !enabled);
                weekendSummaryTextarea.classList.toggle('text-slate-400', !enabled);

                if (!enabled) {
                    weekendSummaryTextarea.value = '';
                }
            };

            weekendSummaryCheckbox.addEventListener('change', applyWeekendSummaryState);
            applyWeekendSummaryState();
        }
    })();
</script>
