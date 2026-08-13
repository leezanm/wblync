<x-app-layout>

    <x-slot name="header">

        <div>

            <p class="text-sm font-semibold text-blue-600">
                {{ $company->code }}
            </p>

            <h2 class="text-2xl font-bold text-slate-800 mt-1">
                Edit Company
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Update company information.
            </p>

        </div>

    </x-slot>


    <div class="max-w-4xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <form
                method="POST"
                action="{{ route('companies.update', $company) }}"
            >

                @csrf
                @method('PUT')

                @include('companies._form')

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

                    <a
                        href="{{ route('companies.index') }}"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
