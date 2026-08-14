<div class="space-y-6">

    {{-- Company --}}
    <div>
        <label
            for="company_id"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Company
        </label>

        <select
            id="company_id"
            name="company_id"
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
        >
            <option value="">
                Select company
            </option>

            @foreach ($companies as $company)
                <option
                    value="{{ $company->id }}"
                    @selected((string) old('company_id', $industrySupervisor->company_id ?? '') === (string) $company->id)
                >
                    {{ $company->code }} - {{ $company->name }}
                </option>
            @endforeach
        </select>

        @error('company_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


   


    {{-- Name --}}
    <div>
        <label
            for="name"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Supervisor Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $industrySupervisor->name ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="Enter supervisor name"
        >

        @error('name')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Position --}}
    <div>
        <label
            for="position"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Position
        </label>

        <input
            type="text"
            id="position"
            name="position"
            value="{{ old('position', $industrySupervisor->position ?? '') }}"
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="e.g. IT Manager"
        >

        @error('position')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Contact --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label
                for="email"
                class="block text-sm font-semibold text-slate-700 mb-2"
            >
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $industrySupervisor->email ?? '') }}"
                required
                class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                placeholder="supervisor@company.com"
            >

            @error('email')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="phone"
                class="block text-sm font-semibold text-slate-700 mb-2"
            >
                Phone
            </label>

            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $industrySupervisor->phone ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                placeholder="012-3456789"
            >

            @error('phone')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
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
                @selected(old('status', $industrySupervisor->status ?? 'Active') === 'Active')
            >
                Active
            </option>

            <option
                value="Inactive"
                @selected(old('status', $industrySupervisor->status ?? '') === 'Inactive')
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


{{-- Actions --}}
<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
    <a
        href="{{ route('industry-supervisors.index') }}"
        class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
    >
        Cancel
    </a>

    <button
        type="submit"
        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-sm"
    >
        <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.8"
                d="M5 12l4 4L19 6"
            />
        </svg>

        {{ isset($industrySupervisor) ? 'Update Supervisor' : 'Create Supervisor' }}
    </button>
</div>
