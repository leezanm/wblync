<div class="space-y-6">

    <div>
        <h3 class="text-lg font-bold text-slate-800">
            Assessment Information
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Record the assessment details for a WBL placement.
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
                                $assessment->placement_id ?? ''
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


        {{-- Assessment Date --}}
        <div>

            <label
                for="assessment_date"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Assessment Date <span class="text-red-500">*</span>
            </label>

            <input
                type="date"
                id="assessment_date"
                name="assessment_date"
                value="{{ old(
                    'assessment_date',
                    isset($assessment) && $assessment->assessment_date
                        ? $assessment->assessment_date->format('Y-m-d')
                        : ''
                ) }}"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('assessment_date')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Score --}}
        <div>

            <label
                for="score"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Score
            </label>

            <input
                type="number"
                id="score"
                name="score"
                value="{{ old(
                    'score',
                    $assessment->score ?? ''
                ) }}"
                min="0"
                max="100"
                step="0.01"
                placeholder="e.g. 85"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('score')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Grade --}}
        <div>

            <label
                for="grade"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Grade
            </label>

            <input
                type="text"
                id="grade"
                name="grade"
                value="{{ old(
                    'grade',
                    $assessment->grade ?? ''
                ) }}"
                maxlength="10"
                placeholder="e.g. A"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('grade')

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
                    'Completed',
                ] as $status)

                    <option
                        value="{{ $status }}"
                        @selected(
                            old(
                                'status',
                                $assessment->status ?? 'Draft'
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
                rows="5"
                placeholder="Enter assessment remarks..."
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >{{ old('remarks', $assessment->remarks ?? '') }}</textarea>

            @error('remarks')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>

</div>
