<div class="space-y-6">

    {{-- Staff No --}}
    <div>
        <label
            for="staff_no"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Staff No
        </label>

        <input
            type="text"
            id="staff_no"
            name="staff_no"
            value="{{ old('staff_no', $lecturer->staff_no ?? '') }}"
            required
            autofocus
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="e.g. L001"
        >

        @error('staff_no')
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
            Full Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $lecturer->name ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="Enter lecturer name"
        >

        @error('name')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Email --}}
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
            value="{{ old('email', $lecturer->email ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="lecturer@polytechnic.edu.my"
        >

        @error('email')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Phone --}}
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
            value="{{ old('phone', $lecturer->phone ?? '') }}"
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="012-3456789"
        >

        @error('phone')
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
                        $lecturer->status ?? 'Active'
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
                        $lecturer->status ?? ''
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


{{-- Actions --}}
<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

    <a
        href="{{ route('lecturers.index') }}"
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

        {{ isset($lecturer) ? 'Update Lecturer' : 'Create Lecturer' }}

    </button>

</div>
