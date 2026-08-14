<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Create User
                </h2>

            </div>

        </div>

    </x-slot>


    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <div class="mb-8">

                <h3 class="text-lg font-bold text-slate-800">
                    User Information
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Create a new system user and assign a role.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('users.store') }}"
            >

                @csrf

                @include('users._form')

            </form>

        </div>

    </div>

</x-app-layout>
