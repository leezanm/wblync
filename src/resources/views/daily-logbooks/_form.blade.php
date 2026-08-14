<div class="space-y-6">

    <div>

        <h3 class="text-lg font-bold text-slate-800">
            Daily Logbook Information
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Record the student's daily WBL activities and learning outcomes.
        </p>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Placement --}}
        <div class="md:col-span-2">

            <label
                for="placement_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Placement <span class="text-red-500">*</span>
            </label>

            <select
                id="placement_id"
                name="placement_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

                <option value="">
                    Select Placement
                </option>

                @foreach ($placements as $placement)

                    <option
                        value="{{ $placement->id }}"
                        @selected(
                            (string) old(
                                'placement_id',
                                $dailyLogbook->placement_id ?? ''
                            ) === (string) $placement->id
                        )
                    >
                        {{ $placement->student->student_no }}
                        -
                        {{ $placement->student->name }}
                        —
                        {{ $placement->company->name }}
                    </option>

                @endforeach

            </select>

            @error('placement_id')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Log Date --}}
        <div>

            <label
                for="log_date"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Log Date <span class="text-red-500">*</span>
            </label>

            <input
                type="date"
                id="log_date"
                name="log_date"
                value="{{ old(
                    'log_date',
                    isset($dailyLogbook) && $dailyLogbook->log_date
                        ? $dailyLogbook->log_date->format('Y-m-d')
                        : ''
                ) }}"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('log_date')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Working Hours --}}
        <div>

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
        <div>

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


        {{-- Activity --}}
        <div class="md:col-span-2">

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
        <div class="md:col-span-2">

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


        {{-- Remarks --}}
        <div class="md:col-span-2">

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
