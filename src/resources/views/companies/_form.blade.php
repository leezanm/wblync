<div class="space-y-6">

    {{-- Basic Information --}}
    <div>
        <h3 class="text-lg font-bold text-slate-800">
            Company Information
        </h3>

        <p class="text-sm text-slate-500 mt-1">
            Enter the basic information of the company.
        </p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Code --}}
        <div>
            <label
                for="code"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Company Code
                <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="code"
                name="code"
                value="{{ old('code', $company->code ?? '') }}"
                required
                maxlength="50"
                placeholder="e.g. COMP001"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('code')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Company Name --}}
        <div>
            <label
                for="name"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Company Name
                <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $company->name ?? '') }}"
                required
                maxlength="255"
                placeholder="e.g. ABC Technology Sdn Bhd"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('name')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Registration No --}}
        <div>
            <label
                for="registration_no"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Registration No.
            </label>

            <input
                type="text"
                id="registration_no"
                name="registration_no"
                value="{{ old('registration_no', $company->registration_no ?? '') }}"
                maxlength="100"
                placeholder="Company registration number"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('registration_no')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Industry --}}
        <div>
            <label
                for="industry"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Industry
            </label>

            <input
                type="text"
                id="industry"
                name="industry"
                value="{{ old('industry', $company->industry ?? '') }}"
                maxlength="255"
                placeholder="e.g. Information Technology"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('industry')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>


    {{-- Contact --}}
    <div class="pt-4 border-t border-slate-100">

        <h3 class="text-lg font-bold text-slate-800">
            Contact Information
        </h3>

        <p class="text-sm text-slate-500 mt-1">
            Contact details for the company.
        </p>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Email --}}
        <div>
            <label
                for="email"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $company->email ?? '') }}"
                maxlength="255"
                placeholder="company@example.com"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
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
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Phone
            </label>

            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $company->phone ?? '') }}"
                maxlength="50"
                placeholder="03-12345678"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('phone')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Website --}}
        <div class="md:col-span-2">

            <label
                for="website"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Website
            </label>

            <input
                type="url"
                id="website"
                name="website"
                value="{{ old('website', $company->website ?? '') }}"
                maxlength="255"
                placeholder="https://www.example.com"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('website')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>


    {{-- Address --}}
    <div class="pt-4 border-t border-slate-100">

        <h3 class="text-lg font-bold text-slate-800">
            Address
        </h3>

    </div>


    <div class="space-y-5">

        {{-- Address --}}
        <div>

            <label
                for="address"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Address
            </label>

            <textarea
                id="address"
                name="address"
                rows="3"
                placeholder="Company address"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >{{ old('address', $company->address ?? '') }}</textarea>

            @error('address')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

            {{-- City --}}
            <div>

                <label
                    for="city"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    City
                </label>

                <input
                    type="text"
                    id="city"
                    name="city"
                    value="{{ old('city', $company->city ?? '') }}"
                    maxlength="100"
                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- State --}}
            <div>

                <label
                    for="state"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    State
                </label>

                <input
                    type="text"
                    id="state"
                    name="state"
                    value="{{ old('state', $company->state ?? '') }}"
                    maxlength="100"
                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Postcode --}}
            <div>

                <label
                    for="postcode"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    Postcode
                </label>

                <input
                    type="text"
                    id="postcode"
                    name="postcode"
                    value="{{ old('postcode', $company->postcode ?? '') }}"
                    maxlength="10"
                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

        </div>

    </div>


    {{-- Status --}}
    <div class="pt-4 border-t border-slate-100">

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
                        $company->status ?? true
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
