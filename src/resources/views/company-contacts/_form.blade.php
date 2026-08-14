<div class="space-y-6">

    <div>
        <h3 class="text-lg font-bold text-slate-800">
            Company Contact Information
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Manage the contact person for an industry partner.
        </p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Company --}}
        <div>
            <label
                for="company_id"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Company <span class="text-red-500">*</span>
            </label>

            <select
                id="company_id"
                name="company_id"
                required
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">Select Company</option>

                @foreach ($companies as $company)
                    <option
                        value="{{ $company->id }}"
                        @selected(
                            (string) old(
                                'company_id',
                                $companyContact->company_id ?? ''
                            ) === (string) $company->id
                        )
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
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Contact Name <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $companyContact->name ?? '') }}"
                required
                maxlength="255"
                placeholder="Enter contact name"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
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
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Position
            </label>

            <input
                type="text"
                id="position"
                name="position"
                value="{{ old('position', $companyContact->position ?? '') }}"
                maxlength="255"
                placeholder="e.g. HR Manager"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('position')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>


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
                value="{{ old('email', $companyContact->email ?? '') }}"
                maxlength="255"
                placeholder="email@company.com"
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
                value="{{ old('phone', $companyContact->phone ?? '') }}"
                maxlength="50"
                placeholder="e.g. 03-12345678"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
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
                <option
                    value="Active"
                    @selected(old(
                        'status',
                        $companyContact->status ?? 'Active'
                    ) === 'Active')
                >
                    Active
                </option>

                <option
                    value="Inactive"
                    @selected(old(
                        'status',
                        $companyContact->status ?? ''
                    ) === 'Inactive')
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

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const companySelect = document.getElementById('company_id');
    const contactSelect = document.getElementById('company_contact_id');

    if (!companySelect || !contactSelect) {
        return;
    }

    const options = Array.from(
        contactSelect.querySelectorAll('option[data-company-id]')
    );

    function filterContacts() {

        const companyId = companySelect.value;

        options.forEach(option => {

            const matches =
                option.dataset.companyId === companyId;

            option.hidden = !matches;

            if (!matches && option.selected) {
                option.selected = false;
            }

        });

        if (!companyId) {
            contactSelect.value = '';
        }
    }

    companySelect.addEventListener(
        'change',
        filterContacts
    );

    filterContacts();

});
</script>
