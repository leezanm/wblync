<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Edit Supervisor
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Update supervisor registration.
            </p>
        </div>

    </x-slot>


    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <div class="mb-8">

                <h3 class="text-lg font-bold text-slate-800">
                    Supervisor Registration
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $supervisor->lecturer?->name }}
                </p>

            </div>

            <form
                method="POST"
                action="{{ route('supervisors.update', $supervisor) }}"
            >

                @csrf
                @method('PUT')

                @include('supervisors._form')

            </form>

        </div>

    </div>

</x-app-layout>
