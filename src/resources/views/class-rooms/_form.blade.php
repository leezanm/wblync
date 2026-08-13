<div class="space-y-6">

    {{-- Academic Session + Semester --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Academic Session --}}
        <div>
            <label
                for="academic_session_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Academic Session
            </label>

            <select
                id="academic_session_id"
                name="academic_session_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">Select academic session</option>

                @foreach ($academicSessions as $academicSession)

                    <option
                        value="{{ $academicSession->id }}"
                        @selected(
                            old(
                                'academic_session_id',
                                $class->academic_session_id ?? ''
                            ) == $academicSession->id
                        )
                    >
                        {{ $academicSession->name }}
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
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Semester
            </label>

            <select
                id="semester_id"
                name="semester_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">Select semester</option>

                @foreach ($semesters ?? [] as $semester)

                    <option
                        value="{{ $semester->id }}"
                        @selected(
                            old(
                                'semester_id',
                                $class->semester_id ?? ''
                            ) == $semester->id
                        )
                    >
                        {{ $semester->code }} - {{ $semester->name }}
                    </option>

                @endforeach
            </select>

            @error('semester_id')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

            <p
                id="semester-loading"
                class="hidden mt-2 text-xs text-slate-500"
            >
                Loading semesters...
            </p>
        </div>

    </div>


    {{-- Programme --}}
    <div>

        <label
            for="programme_id"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Programme
        </label>

        <select
            id="programme_id"
            name="programme_id"
            required
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

            <option value="">Select programme</option>

            @foreach ($programmes as $programme)

                <option
                    value="{{ $programme->id }}"
                    @selected(
                        old(
                            'programme_id',
                            $class->programme_id ?? ''
                        ) == $programme->id
                    )
                >
                    {{ $programme->code }} - {{ $programme->name }}
                </option>

            @endforeach

        </select>

        @error('programme_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Class Code --}}
    <div>

        <label
            for="code"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Class Code
        </label>

        <input
            id="code"
            type="text"
            name="code"
            value="{{ old('code', $class->code ?? '') }}"
            placeholder="e.g. DIT1A"
            required
            maxlength="50"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 uppercase focus:border-blue-500 focus:ring-blue-500"
        >

        @error('code')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Class Name --}}
    <div>

        <label
            for="name"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Class Name
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $class->name ?? '') }}"
            placeholder="e.g. Diploma In TI - Class A"
            required
            maxlength="150"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

        @error('name')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Status --}}
    <div>

        <label class="inline-flex items-center gap-3 cursor-pointer">

            <input
                type="hidden"
                name="status"
                value="0"
            >

            <input
                type="checkbox"
                name="status"
                value="1"
                @checked(
                    old(
                        'status',
                        $class->status ?? true
                    )
                )
                class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
            >

            <span class="text-sm font-medium text-slate-700">
                Active
            </span>

        </label>

        @error('status')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>


{{-- Dependent Semester --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const sessionSelect = document.getElementById('academic_session_id');
    const semesterSelect = document.getElementById('semester_id');
    const loadingText = document.getElementById('semester-loading');

    if (!sessionSelect || !semesterSelect) {
        return;
    }

    const selectedSemester = @json(
        old('semester_id', $class->semester_id ?? '')
    );

    async function loadSemesters(sessionId, selectedId = null) {

        semesterSelect.disabled = true;

        loadingText.classList.remove('hidden');

        semesterSelect.innerHTML = `
            <option value="">Loading semesters...</option>
        `;

        if (!sessionId) {

            semesterSelect.innerHTML = `
                <option value="">Select semester</option>
            `;

            loadingText.classList.add('hidden');
            semesterSelect.disabled = true;

            return;
        }

        try {

            const response = await fetch(
                `/academic-sessions/${sessionId}/semesters`,
                {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                }
            );

            if (!response.ok) {
                throw new Error('Failed to load semesters.');
            }

            const semesters = await response.json();

            semesterSelect.innerHTML = `
                <option value="">Select semester</option>
            `;

            semesters.forEach(function (semester) {

                const option = document.createElement('option');

                option.value = semester.id;

                option.textContent =
                    `${semester.code} - ${semester.name}`;

                if (
                    selectedId &&
                    String(selectedId) === String(semester.id)
                ) {
                    option.selected = true;
                }

                semesterSelect.appendChild(option);
            });

            semesterSelect.disabled = semesters.length === 0;

            if (semesters.length === 0) {

                semesterSelect.innerHTML = `
                    <option value="">
                        No semesters available
                    </option>
                `;
            }

        } catch (error) {

            console.error(error);

            semesterSelect.innerHTML = `
                <option value="">
                    Unable to load semesters
                </option>
            `;

            semesterSelect.disabled = true;

        } finally {

            loadingText.classList.add('hidden');

        }
    }


    sessionSelect.addEventListener('change', function () {

        loadSemesters(this.value);

    });


    // Create / Edit / Validation error
    if (sessionSelect.value) {

        loadSemesters(
            sessionSelect.value,
            selectedSemester
        );

    }

});
</script>
