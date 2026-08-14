<div class="space-y-6">

    {{-- Placement Information --}}
    <div>
        <h3 class="text-lg font-bold text-slate-800">
            Placement Information
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Assign a student to a company for WBL placement.
        </p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Student --}}
        <div>
            <label
                for="student_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Student
                <span class="text-red-500">*</span>
            </label>

            <select
                id="student_id"
                name="student_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">
                    Select Student
                </option>

                @foreach ($students as $student)
                    <option
                        value="{{ $student->id }}"
                        @selected(
                            (string) old(
                                'student_id',
                                $placement->student_id ?? ''
                            ) === (string) $student->id
                        )
                    >
                        {{ $student->student_no }} -
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>

            @error('student_id')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Company --}}
        <div>
            <label
                for="company_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Company
                <span class="text-red-500">*</span>
            </label>

            <select
                id="company_id"
                name="company_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">
                    Select Company
                </option>

                @foreach ($companies as $company)
                    <option
                        value="{{ $company->id }}"
                        @selected(
                            (string) old(
                                'company_id',
                                $placement->company_id ?? ''
                            ) === (string) $company->id
                        )
                    >
                        {{ $company->code }} -
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>

            @error('company_id')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Academic Session --}}
        <div>
            <label
                for="academic_session_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Academic Session
                <span class="text-red-500">*</span>
            </label>

            <select
                id="academic_session_id"
                name="academic_session_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">
                    Select Academic Session
                </option>

                @foreach ($academicSessions as $session)
                    <option
                        value="{{ $session->id }}"
                        @selected(
                            (string) old(
                                'academic_session_id',
                                $placement->academic_session_id ?? ''
                            ) === (string) $session->id
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


        

        {{-- Industry Supervisor --}}
        <div>
            <label
                for="industry_supervisor_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Industry Supervisor
            </label>

            <select
                id="industry_supervisor_id"
                name="industry_supervisor_id"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">
                    Select Industry Supervisor
                </option>

                @foreach ($industrySupervisors as $supervisor)
                    <option
                        value="{{ $supervisor->id }}"
                        data-company-id="{{ $supervisor->company_id }}"
                        @selected(
                            (string) old(
                                'industry_supervisor_id',
                                $placement->industry_supervisor_id ?? ''
                            ) === (string) $supervisor->id
                        )
                    >
                        {{ $supervisor->name }}
                        -
                        {{ $supervisor->company?->code ?? '-' }}
                        {{ $supervisor->company?->name ?? '-' }}
                    </option>
                @endforeach
            </select>

            @error('industry_supervisor_id')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Status --}}
        {{-- <div>
            <label
                for="status"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Status
                <span class="text-red-500">*</span>
            </label>

            <select
                id="status"
                name="status"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                @foreach ($statuses as $status)
                    <option
                        value="{{ $status }}"
                        @selected(
                            old(
                                'status',
                                $placement->status ?? 'Draft'
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
        </div> --}}


        {{-- Start Date --}}
        <div>
            <label
                for="start_date"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Start Date
                <span class="text-red-500">*</span>
            </label>

            <input
                type="date"
                id="start_date"
                name="start_date"
                value="{{ old('start_date', isset($placement) && $placement->start_date ? $placement->start_date->format('Y-m-d') : '') }}"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('start_date')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <script>
            (function () {
                const companySelect = document.getElementById('company_id');
                const supervisorSelect = document.getElementById('industry_supervisor_id');

                if (!companySelect || !supervisorSelect) {
                    return;
                }

                const supervisorOptions = Array.from(supervisorSelect.options).slice(1);

                const filterByCompany = (selectEl, options, companyId) => {
                    const currentValue = selectEl.value;
                    let hasCurrentValue = false;

                    options.forEach((option) => {
                        const match = !companyId || option.dataset.companyId === companyId;
                        option.hidden = !match;
                        option.disabled = !match;

                        if (option.value === currentValue && match) {
                            hasCurrentValue = true;
                        }
                    });

                    if (currentValue && !hasCurrentValue) {
                        selectEl.value = '';
                    }
                };

                const applyFilters = () => {
                    const companyId = companySelect.value;
                    filterByCompany(supervisorSelect, supervisorOptions, companyId);
                };

                companySelect.addEventListener('change', applyFilters);
                applyFilters();
            })();
        </script>


        {{-- End Date --}}
        <div>
            <label
                for="end_date"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                End Date
                <span class="text-red-500">*</span>
            </label>

            <input
                type="date"
                id="end_date"
                name="end_date"
                value="{{ old('end_date', isset($placement) && $placement->end_date ? $placement->end_date->format('Y-m-d') : '') }}"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('end_date')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>


    {{-- Remarks --}}
    <div class="pt-4 border-t border-slate-100">

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
        >{{ old('remarks', $placement->remarks ?? '') }}</textarea>

        @error('remarks')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>
