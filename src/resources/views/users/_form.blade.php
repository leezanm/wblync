<div class="space-y-6">

    {{-- Name --}}
    <div>
        <label
            for="name"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $user->name ?? '') }}"
            required
            autofocus
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="Enter user name"
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
            value="{{ old('email', $user->email ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
            placeholder="user@example.com"
        >

        @error('email')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Role --}}
    <div>
        <label
            for="role"
            class="block text-sm font-semibold text-slate-700 mb-2"
        >
            Role
        </label>

        <select
            id="role"
            name="role"
            required
            class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
        >

            <option value="">
                Select role
            </option>

            @foreach ($roles as $role)

                <option
                    value="{{ $role->name }}"
                    @selected(
                        old(
                            'role',
                            isset($user)
                                ? $user->roles->first()?->name
                                : ''
                        ) === $role->name
                    )
                >
                    {{ $role->name }}
                </option>

            @endforeach

        </select>

        @error('role')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Password --}}
    {{-- Create use default password / Edit cant change the password --}}
    {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>

            <label
                for="password"
                class="block text-sm font-semibold text-slate-700 mb-2"
            >
                Password

                @isset($user)
                    <span class="font-normal text-slate-400">
                        (leave blank to keep current)
                    </span>
                @endisset
            </label>

            <input
                type="password"
                id="password"
                name="password"
                {{ isset($user) ? '' : 'required' }}
                class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Minimum 8 characters"
            >

            @error('password')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        <div>

            <label
                for="password_confirmation"
                class="block text-sm font-semibold text-slate-700 mb-2"
            >
                Confirm Password
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                {{ isset($user) ? '' : 'required' }}
                class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Confirm password"
            >

        </div>

    </div> --}}

</div>


{{-- Actions --}}
<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

    <a
        href="{{ route('users.index') }}"
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

        {{ isset($user) ? 'Update User' : 'Create User' }}

    </button>

</div>
