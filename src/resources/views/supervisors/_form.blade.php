<div class="space-y-6">

    {{-- Lecturer --}}
    <div>
        <label
            for="lecturer_id"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Lecturer
        </label>

        <select
            id="lecturer_id"
            name="lecturer_id"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
        >
            <option value="">
                Select lecturer
            </option>

            @foreach ($lecturers as $lecturer)
                <option
                    value="{{ $lecturer->id }}"
                    @selected(
                        old(
                            'lecturer_id',
                            $supervisor->lecturer_id ?? ''
                        ) == $lecturer->id
                    )
                >
                    {{ $lecturer->staff_no }} - {{ $lecturer->name }}
                </option>
            @endforeach
        </select>

        @error('lecturer_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Academic Session --}}
    <div>
        <label
            for="academic_session_id"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Academic Session
        </label>

        <select
            id="academic_session_id"
            name="academic_session_id"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
        >
            <option value="">
                Select academic session
            </option>

            @foreach ($academicSessions as $session)
                <option
                    value="{{ $session->id }}"
                    @selected(
                        old(
                            'academic_session_id',
                            $supervisor->academic_session_id ?? ''
                        ) == $session->id
                    )
                >
                    {{ $session->name }}
                </option>
            @endforeach
        </select>

        @error('academic_session_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Semester --}}
    <div>
        <label
            for="semester_id"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Semester
        </label>

        <select
            id="semester_id"
            name="semester_id"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
        >
            <option value="">
                Select semester
            </option>

            @foreach ($semesters as $semester)
                <option
                    value="{{ $semester->id }}"
                    @selected(
                        old(
                            'semester_id',
                            $supervisor->semester_id ?? ''
                        ) == $semester->id
                    )
                >
                    {{ $semester->name }}
                </option>
            @endforeach
        </select>

        @error('semester_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Status --}}
    <div>
        <label
            for="status"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Status
        </label>

        <select
            id="status"
            name="status"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
        >
            <option
                value="Active"
                @selected(
                    old(
                        'status',
                        $supervisor->status ?? 'Active'
                    ) === 'Active'
                )
            >
                Active
            </option>

            <option
                value="Inactive"
                @selected(
                    old(
                        'status',
                        $supervisor->status ?? ''
                    ) === 'Inactive'
                )
            >
                Inactive
            </option>
        </select>

        @error('status')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

</div>


<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

    <a
        href="{{ route('supervisors.index') }}"
        class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
    >
        Cancel
    </a>

    <button
        type="submit"
        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
    >
        {{ isset($supervisor) ? 'Update Supervisor' : 'Create Supervisor' }}
    </button>

</div>
